<?php
$navbarMB = ($type == 'type-tile') ? 'mb-dynamic' : 'mb0';
switch ($position) {
    case 'logo-top-left':?>
        <div class="navbar navbar-default <?=$navbarMB;?>" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle pull-left collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar top-line relative"></span>
                    <span class="icon-bar center-line"></span>
                    <span class="icon-bar bottom-line relative"></span>
                </button>
                <a class="navbar-brand pull-right" href="http://bootstrap-3.ru/examples/jumbotron/#">your logo</a>
            </div>
            <div class="navbar-collapse collapse z1">
                <ul class="nav navbar-nav navbar-right mr0">
                    <li><a href="#">works</a></li>
                    <li><a href="#">about</a></li>
                    <li><a href="#">contacts</a></li>
                </ul>
            </div>
        </div>
        <?break;
    case 'logo-top-right':?>
        <div class="navbar navbar-default <?=$navbarMB;?>" role="navigation">
            <div class="navbar-header navbar-right mr0">
                <button type="button" class="navbar-toggle pull-left collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar top-line relative"></span>
                    <span class="icon-bar center-line"></span>
                    <span class="icon-bar bottom-line relative"></span>
                </button>
                <a class="navbar-brand pull-right" href="http://bootstrap-3.ru/examples/jumbotron/#">your logo</a>
            </div>
            <div class="navbar-collapse collapse z1">
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="#">works</a></li>
                    <li><a href="#">about</a></li>
                    <li><a href="#">contacts</a></li>
                </ul>
            </div>
        </div>
        <?break;
    case 'logo-top-center':?>
        <div class="navbar navbar-default <?=$navbarMB;?>" role="navigation">
            <div class="navbar-header mr0">
                <button type="button" class="navbar-toggle pull-left collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar top-line relative"></span>
                    <span class="icon-bar center-line"></span>
                    <span class="icon-bar bottom-line relative"></span>
                </button>
                <div class="text-center brand-center absolute right0 left0 top0">
                    <a class="navbar-brand" href="http://bootstrap-3.ru/examples/jumbotron/#">your logo</a>
                </div>
            </div>
            <div class="navbar-collapse collapse z1">
                <div class="navbar-cell">
                    <ul class="nav navbar-nav navbar-left">
                        <li><a href="#">works</a></li>
                        <li><a href="#">about</a></li>
                        <li><a href="#">contacts</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">works</a></li>
                        <li><a href="#">about</a></li>
                        <li><a href="#">contacts</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?break;
    case 'logo-mobile':?>
        <div class="navbar navbar-default <?=$navbarMB;?>" role="navigation">
            <div class="navbar-header header-mobile float-none">
                <button type="button" class="navbar-toggle pull-left collapsed inline-block" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar top-line relative"></span>
                    <span class="icon-bar center-line"></span>
                    <span class="icon-bar bottom-line relative"></span>
                </button>
                <a class="navbar-brand" href="http://bootstrap-3.ru/examples/jumbotron/#">your logo</a>
            </div>
            <div class="navbar-collapse collapse z1 hide-mb-lg">
                <div class="navbar-cell">
                    <ul class="nav navbar-nav float-none mr0">
                        <li class="float-none"><a href="#">works</a></li>
                        <li class="float-none"><a href="#">about</a></li>
                        <li class="float-none"><a href="#">contacts</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?break;
    case 'logo-box-left':?>
        <div class="navbar navbar-default <?=($type == 'type-tile') ? 'mb-dynamic' : '';?> navbar-margin" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle pull-left collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar top-line relative"></span>
                    <span class="icon-bar center-line"></span>
                    <span class="icon-bar bottom-line relative"></span>
                </button>
                <a class="navbar-brand pull-right" href="http://bootstrap-3.ru/examples/jumbotron/#">your logo</a>
            </div>
            <div class="navbar-collapse collapse z1">
                <ul class="nav navbar-nav navbar-right mr0">
                    <li><a href="#">works</a></li>
                    <li><a href="#">about</a></li>
                    <li><a href="#">contacts</a></li>
                </ul>
            </div>
        </div>
        <?break;
    case 'logo-box-right':?>
        <div class="navbar navbar-default <?=($type == 'type-tile') ? 'mb-dynamic' : '';?> navbar-margin" role="navigation">
            <div class="navbar-header navbar-right mr0">
                <button type="button" class="navbar-toggle pull-left collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar top-line relative"></span>
                    <span class="icon-bar center-line"></span>
                    <span class="icon-bar bottom-line relative"></span>
                </button>
                <a class="navbar-brand pull-right" href="http://bootstrap-3.ru/examples/jumbotron/#">your logo</a>
            </div>
            <div class="navbar-collapse collapse z1">
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="#">works</a></li>
                    <li><a href="#">about</a></li>
                    <li><a href="#">contacts</a></li>
                </ul>
            </div>
        </div>
        <?break;
    case 'logo-2line-center':?>
        <div class="navbar navbar-default <?=$navbarMB;?> line2x" role="navigation">
            <div class="navbar-header mr0 float-none">
                <button type="button" class="navbar-toggle pull-left collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar top-line relative"></span>
                    <span class="icon-bar center-line"></span>
                    <span class="icon-bar bottom-line relative"></span>
                </button>
                <div class="text-center brand-center right0 left0 top0">
                    <a class="navbar-brand" href="http://bootstrap-3.ru/examples/jumbotron/#">your logo</a>
                </div>
            </div>
            <div class="navbar-collapse collapse z1">
                <div class="navbar-cell text-center">
                    <ul class="nav navbar-nav float-none inline-block">
                        <li><a href="#">works</a></li>
                        <li><a href="#">about</a></li>
                        <li><a href="#">contacts</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?break;
    case 'logo-2line-left':?>
        <div class="navbar navbar-default <?=$navbarMB;?> line2x" role="navigation">
            <div class="navbar-header mr0 float-none">
                <button type="button" class="navbar-toggle pull-left collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar top-line relative"></span>
                    <span class="icon-bar center-line"></span>
                    <span class="icon-bar bottom-line relative"></span>
                </button>
                <div class="brand-center right0 left0 top0">
                    <a class="navbar-brand" href="http://bootstrap-3.ru/examples/jumbotron/#">your logo</a>
                </div>
            </div>
            <div class="navbar-collapse collapse z1">
                <div class="navbar-cell">
                    <ul class="nav navbar-nav">
                        <li><a href="#">works</a></li>
                        <li><a href="#">about</a></li>
                        <li><a href="#">contacts</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?break;
    case 'logo-2line-right':?>
        <div class="navbar navbar-default <?=$navbarMB;?> line2x" role="navigation">
            <div class="navbar-header mr0 float-none">
                <button type="button" class="navbar-toggle pull-left collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar top-line relative"></span>
                    <span class="icon-bar center-line"></span>
                    <span class="icon-bar bottom-line relative"></span>
                </button>
                <div class="brand-center right0 left0 top0">
                    <a class="navbar-brand pull-right" href="http://bootstrap-3.ru/examples/jumbotron/#">your logo</a>
                </div>
            </div>
            <div class="navbar-collapse collapse z1">
                <div class="navbar-cell">
                    <ul class="nav navbar-nav  navbar-right">
                        <li><a href="#">works</a></li>
                        <li><a href="#">about</a></li>
                        <li><a href="#">contacts</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?break;
    case 'logo-fixed-left':?>
        <div class="mb-dynamic hidden-xs hidden-sm"></div>
        <div class="navbar navbar-default <?=$navbarMB;?> navbar-fixed left0" role="navigation">
            <div class="navbar-header float-none">
                <button type="button" class="navbar-toggle pull-left collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar top-line relative"></span>
                    <span class="icon-bar center-line"></span>
                    <span class="icon-bar bottom-line relative"></span>
                </button>
                <div class="brand-center text-center">
                    <a class="navbar-brand" href="http://bootstrap-3.ru/examples/jumbotron/#">your logo</a>
                </div>
            </div>
            <div class="navbar-collapse collapse text-center z1">
                <div class="navbar-cell">
                    <ul class="nav navbar-nav float-none mr0">
                        <li class="float-none"><a href="#">works</a></li>
                        <li class="float-none"><a href="#">about</a></li>
                        <li class="float-none"><a href="#">contacts</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?break;
    case 'logo-fixed-right':?>
        <div class="mb-dynamic hidden-xs hidden-sm"></div>
        <div class="navbar navbar-default <?=$navbarMB;?> navbar-fixed right0" role="navigation">
            <div class="navbar-header float-none">
                <button type="button" class="navbar-toggle pull-left collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar top-line relative"></span>
                    <span class="icon-bar center-line"></span>
                    <span class="icon-bar bottom-line relative"></span>
                </button>
                <div class="brand-center text-center">
                    <a class="navbar-brand" href="http://bootstrap-3.ru/examples/jumbotron/#">your logo</a>
                </div>
            </div>
            <div class="navbar-collapse collapse text-center z1">
                <div class="navbar-cell">
                    <ul class="nav navbar-nav float-none mr0">
                        <li class="float-none"><a href="#">works</a></li>
                        <li class="float-none"><a href="#">about</a></li>
                        <li class="float-none"><a href="#">contacts</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?break;
    case 'logo-bottom':?>
        <div class="mb-dynamic hidden-xs hidden-sm"></div>
        <div class="navbar navbar-default <?=$navbarMB;?> navbar-fixed-bottom" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle pull-left collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar top-line relative"></span>
                    <span class="icon-bar center-line"></span>
                    <span class="icon-bar bottom-line relative"></span>
                </button>
                <a class="navbar-brand pull-right" href="http://bootstrap-3.ru/examples/jumbotron/#">your logo</a>
            </div>
            <div class="navbar-collapse collapse z1">
                <ul class="nav navbar-nav navbar-right mr0">
                    <li><a href="#">works</a></li>
                    <li><a href="#">about</a></li>
                    <li><a href="#">contacts</a></li>
                </ul>
            </div>
        </div>
        <?break;
}
?>