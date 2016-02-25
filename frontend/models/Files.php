<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * UploadForm is the model behind the upload form.
 */
class Files extends \yii\base\Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $file;
    public $uploadType;
    public static $defaultAcceptExt = ['jpg', 'gif', 'png', 'jpeg']; //, 'ico'
    public static $typeParamFiles = [
        'logo' => [
            'mimeTypes'       => ["image/jpg", "image/jpeg", "image/png", "image/gif"],
            'typeFileCaption' => "jpg, gif, png, jpeg",
            'maxSize'         => 1048576,
            'maxSizeCaption'  => '1 Мб',
            'minImgSize'      => ['w' => 200, 'h' => 150],
        ],
        'favicon' => [
            'mimeTypes'       => ["image/png", "image/gif"], //"image/x-icon",
            'typeFileCaption' => "gif, png", //ico,
            'maxSize'         => 1048576,
            'maxSizeCaption'  => '1 Мб',
            'minImgSize'      => ['w' => 16, 'h' => 16],
        ],
        'bg' => [
            'mimeTypes'       => ["image/jpg", "image/jpeg", "image/png", "image/gif"],
            'typeFileCaption' => "jpg, gif, png, jpeg",
            'maxSize'         => 1048576,
            'maxSizeCaption'  => '1 Мб',
            'minImgSize'      => ['w' => 1024, 'h' => 768],
        ],
    ];
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file'], 'file'],
            [['file'], 'checkToType'],
        ];
    }

    public function checkToType($attribute)
    {
        $typeParam = self::$typeParamFiles;
        $type = $this->uploadType;
        if (array_key_exists($type, $typeParam)) {
            $file = $this->$attribute;
            $imgSize = getimagesize($file->tempName);
            //проверка ошибок сервера
            if ($file->error == 0) {
                //проверка максимального размера загружаемого файла
                if ($file->size < $typeParam[$type]['maxSize']) {
                    //проверка существования временного файла с 0 размером (известный баг в сафари при мульти загрузке файлов)
                    if (!($file->tempName && !is_array($imgSize) && $file->size == 0)) {
                        //проверка допустимых расширений
                        $ext = explode('.', $file->name);
                        $ext = strtolower($ext[(count($ext) - 1)]);
                        $acceptExt = explode(', ', $typeParam[$type]['typeFileCaption']);
                        if (in_array($ext, $acceptExt) && in_array($file->type, $typeParam[$type]['mimeTypes'])) {
                            //проверка минимальных ширины/высоты для изображений
                            if ($typeParam[$type]['minImgSize']) {
                                if ($imgSize[0] < $typeParam[$type]['minImgSize']['w'] || $imgSize[1] < $typeParam[$type]['minImgSize']['h']) {
                                    $this->addError($attribute, "Ошибка! Минимальное разрешение загружаемого файла {$typeParam[$type]['minImgSize']['w']}*{$typeParam[$type]['minImgSize']['h']}px.");
                                }
                            }
                        } else {
                            $this->addError($attribute, "Ошибка! Недопустимое расширение файла ({$typeParam[$type]['typeFileCaption']})");
                        }
                    } else {
                        $this->addError($attribute, 'Ваш браузер не поддерживает множественную загрузку файлов. Возможна загрузка только по одному файлу.');
                    }
                } else {
                    $this->addError($attribute, "Ошибка! Максимальный размер загружаемого файла {$typeParam[$type]['maxSizeCaption']}");
                }
            } else {
                if ($file->error == 1 || $file->error == 2) {
                    $this->addError($attribute, "Ошибка! Максимальный размер загружаемого файла {$typeParam[$type]['maxSizeCaption']}");
                } else {
                    $this->addError($attribute, 'Ошибка при загрузке файла, пожалуйста попробуйте позже.');
                }
            }
        } else {
            $this->addError($attribute, 'Ошибка! Указана несуществующая категория файла.');
        }
    }

    public static function safeFileName($filename, $path, $autoRename = true)
    {
        $filename = explode('.', $filename);
        $extension = $filename[count($filename)-1];
        unset($filename[count($filename)-1]);
        $fname = \app\helpers\TemplateHelper::transliterate(implode('.', $filename));
        $filename = $fname . '.' . $extension;

        if ($autoRename) {
            $limit = 500;
            while (file_exists($path . $filename) && $limit > 0) {
                $suffix = substr(md5(time() . rand(0, 9999)), 0, 10);
                $filename = $fname . "_" . $suffix . "." . $extension;
                $limit--;
            }
            if (file_exists($path . $filename)) {
                $limit = 500;
                while (file_exists($path . $filename) && $limit > 0) {
                    $prefix = substr(md5(time() . rand(0, 9999)), 0, 10);
                    $filename = $prefix . "_" . $filename;
                    $limit--;
                }
            }
        }
        return $filename;
    }

    public static function uploadFileToPath($f, $path, $checkImg = false)
    {
        if (isset($f) && count($f) > 0) {
            $fullpath = Yii::getAlias("@webroot{$path}");
            if (!is_dir($fullpath)) {
                mkdir($fullpath, 0755, true);
            }
            $f_name = self::safeFileName($f->name, $fullpath);
            $fullName = $fullpath . $f_name;
            $ext = explode('.', $f_name);
            $ext = strtolower($ext[(count($ext) - 1)]);
            if (!in_array($ext, self::$defaultAcceptExt)) {
                return false;
            }
            if ($f->saveAs($fullName)) {
                if ($checkImg) {
                    $tmpImage = 'empty';
                    switch ($ext) {
                        case "jpeg":
                        case "jpg":
                            $tmpImage = imagecreatefromjpeg($fullName);
                            break;
                        case "png":
                            $tmpImage = imagecreatefrompng($fullName);
                            break;
                        case "gif":
                            $tmpImage = imagecreatefromgif($fullName);
                            break;
                    }
                    if ($tmpImage === false) {
                        @unlink($fullName);
                        return 'errorImageCreate';
                    } elseif ($tmpImage !== 'empty') {
                        ImageDestroy($tmpImage);
                    }
                }
                list($img_width, $img_height) = getimagesize($fullName);
                return array(
                    'img'        => $path.$f_name,
                    'filename'   => $f_name,
                    'img_width'  => $img_width,
                    'img_height' => $img_height
                );
            } else {
                return false;
            }
        }
    }

    public static function deleteFile($path)
    {
        $path = Yii::getAlias("@webroot{$path}");
        $resultUnlink = @unlink($path);
        $path = explode('/',$path);
        $dest = explode('.',$path[count($path)-1]);
        $exp = $dest[count($dest)-1];
        unset($dest[count($dest)-1]);
        $path[count($path)-1] = 'thumb/'.implode('.',$dest).'/';
        $dest = implode('/', $path);
        self::deleteDir($dest);
    }

    public static function deleteDir($dir)
    {
        if (mb_substr($dir, -1, 1) != "/") $dir .= "/";
        if (is_dir($dir)) {
            if ($f = opendir($dir)) {
                while (false !== ($entry = readdir($f))) {
                    if ($entry != "." && $entry != "..") {
                        if (is_dir($dir.$entry)) {
                            self::deleteDir($dir.$entry);
                        } else {
                            @unlink($dir.$entry);
                        }
                    }
                }
                closedir($f);
            }
            @rmdir($dir);
        }
    }

    /**
     * Генерация превью из исходного изображения
     *
     * $params - массив параметров, на основании которых генерируется превью
     *
     * @param string $src путь исходного изображения (напр. /images/no_photo.jpg)
     * @param integer $width ширина превью
     * @param integer $height высота превью
     * @param boolean $feet to feet photo or not
     * @param boolean $crop to crop photo or not
     * @param array $coords coords area to crop
     * @param array $return_size возвращает массив, содержащий адрес превью и его ширину/высоту
     * @param boolean $thumb возвращает превью в сыром виде
     * @param boolean $rewrite перезаписать исходное изображение
     * @param string $bgcolor цвет фона превью
     * @return по умолчанию возвращает адрес превью
     */
    public static function previewImage($params)
    {
        if (is_array($params)) {
            $name = $params['src'];
            $target_width = intval($params['width']);
            $target_height = intval($params['height']);
            $crop = (isset($params['crop'])) ? $params['crop'] : false;
            $feet = (isset($params['feet'])) ? $params['feet'] : true;
            $coords = (isset($params['coords'])) ? $params['coords'] : array();
            $return_size = (isset($params['return_size'])) ? $params['return_size'] : false;
            $thumb = (isset($params['thumb'])) ? $params['thumb'] : false;
            $rewrite = (isset($params['rewrite'])) ? $params['rewrite'] : false;
            $bgcolor = (isset($params['bgcolor'])) ? $params['bgcolor'] : false;
            $suffix = (isset($params['suffix'])) ? $params['suffix'] : '';
        }

        if ($name[0]=='/') $name=substr($name,1);
        $target_path = Yii::getAlias("@webroot/{$name}");
        if (!file_exists($target_path) || filesize($target_path) == 0)
            return '/'.$name;
        $extension = pathinfo($target_path);
        $extension = strtolower($extension['extension']);
        $path = explode('/',$name);
        $dest = explode('.',$path[count($path)-1]);
        $exp = $dest[count($dest)-1];
        unset($dest[count($dest)-1]);
        if ($rewrite) {
            unset($path[count($path)-1]);
            $path = implode('/', $path);
            $dest = $name;
        }
        else {
            $path[count($path)-1] = 'thumb/'.implode('.',$dest).'/';
            $path = implode('/', $path);
            $dest = $path . $target_width . '_' . $target_height . $suffix . '.' . $extension;
        }
        if (!file_exists(Yii::getAlias("@webroot/{$dest}")) || $rewrite) {
            switch($extension){
                case "jpeg":
                case "jpg": $tmp_image=imagecreatefromjpeg($target_path);
                    break;
                case "png": $tmp_image=imagecreatefrompng($target_path);
                    break;
                case "gif": $tmp_image=imagecreatefromgif($target_path);
                    break;
                default: return '/'.$name;
            }

            $width = imagesx($tmp_image);
            $height = imagesy($tmp_image);
            if ($thumb && (($target_width > 0 && $target_width >= $width) || ($target_height > 0 && $target_height >= $height))) {
                return file_get_contents(Yii::getAlias("@webroot/{$name}"));
            }

            $src_x = 0;
            $src_y = 0;
            $src_width = $width;
            $src_height = $height;
            $dest_x = $dest_y = 0;

            if($target_height == 0) {
                $target_height = ($target_width*$src_height/$src_width);
            }
            elseif ($target_width == 0) {
                $target_width = ($target_height*$src_width/$src_height);
            }
            $new_image = imagecreatetruecolor($target_width,$target_height);
            if($extension == "png"){
                imagealphablending($new_image, false);
                imagesavealpha($new_image, true);
                $white = imagecolorallocatealpha($new_image, 255, 255, 255,127);
                imagefilledrectangle($new_image, 0, 0, $target_width, $target_height, $white);
            }
            $coordsCount = count($coords);
            if ($crop && $coordsCount!=2 && $coordsCount!=4) {
                if ($feet) {
                    if ($target_width / $target_height > $width / $height) {
                        $dest_x = ($target_width - ($target_height*$width/$height))/2;
                        $target_width = $target_height*$width/$height;
                    }
                    else {
                        $dest_y = ($target_height - ($target_width*$height/$width))/2;
                        $target_height = $target_width*$height/$width;
                    }
                } else {
                    if ($target_width/$target_height > $width / $height) {
                        $src_y = ($height - $width*$target_height/$target_width) /2;
                        $src_height = $width*$target_height/$target_width;
                    }
                    else {
                        $src_x = ($width - $height*$target_width/$target_height) /2;
                        $src_width = $height*$target_width/$target_height;
                    }
                }
            }elseif($crop && $coordsCount==2){
                $src_x = $coords[0];
                $src_y = $coords[1];
                if ($target_width/$target_height > $width / $height) {
                    $src_height = $width*$target_height/$target_width;
                } else {
                    $src_width = $height*$target_width/$target_height;
                }
            }elseif($crop && $coordsCount==4){
                $src_x = $coords['x1'];
                $src_y = $coords['y1'];
                $src_width = $coords['w'];
                $src_height = $coords['h'];
            }elseif($target_height==0){
                $target_height = $target_width*$src_height/$src_width;
            }
            else {
                if ($target_width/$target_height < $width / $height) {
                    $dest_y = (($target_height - $target_width*$src_height/$src_width)/2);
                    $target_height = ($target_width*$src_height/$src_width);
                }
                else {
                    $dest_x = (($target_width - $target_height*$src_width/$src_height)/2);
                    $target_width = $target_height*$src_width/$src_height;
                }
            }
            if(!is_dir($path)) {
                mkdir($path, 0755, true);
            }
            if ($bgcolor)
                imagefill($new_image, 0, 0, $bgcolor);
            ImageCopyResampled($new_image, $tmp_image,$dest_x,$dest_y,$src_x,$src_y, $target_width, $target_height, $src_width, $src_height);
            switch($extension){
                case "jpeg":
                case "jpg": imageJpeg($new_image, Yii::getAlias("@webroot/{$dest}"), 85);
                    break;
                case "png": imagepng($new_image, Yii::getAlias("@webroot/{$dest}"), 9);
                    break;
                case "gif": imageGif($new_image, Yii::getAlias("@webroot/{$dest}"), 85);
                    break;
            }
            ImageDestroy($new_image);
            ImageDestroy($tmp_image);
        }
        if ($return_size) {
            $size = getimagesize($dest);
            return array('url'=>'/'.$dest, 'width'=>$size[0], 'height'=>$size[1]);
        } elseif($thumb) {
            switch($extension){
                case "jpeg":
                case "jpg": header('Content-Type: image/jpeg');
                    break;
                case "png": header('Content-Type: image/png');
                    break;
                case "gif": header('Content-Type: image/gif');
                    break;
            }
            return file_get_contents(Yii::getAlias("@webroot/{$dest}"));
        } else {
            return '/'.$dest;
        }
    }
}