<style>
    @font-face {
        src: url("fonts/Roboto-Regular.ttf");
        font-family: Roboto;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Roboto", sans-serif;
    }

    ul,
    ol {
        list-style: none;
    }

    body {
        background: #f8f8f8;
        padding: 2rem;
    }

    .uploader {
        width: 600px;
        margin: 0 auto;
        padding: 2rem;
        background: #fff;
        box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.12);
        border-radius: 3px;
    }

    .uploader-title {
        font-size: 18px;
        color: #505050;
        text-align: center;
        margin-bottom: 36px;
    }

    .uploader>.list {
        padding-left: 0;
    }

    .list {
        padding-left: 36px;
        /* margin-top: 10px; */
    }

    .list li:first-child .folder,
    .list li:first-child.file {
        border-top: none;
    }

    .folder {
        border-bottom: 1px solid #ddd;
    }

    .folder,
    .file {
        padding: 16px 0;
        display: flex;
        align-items: center;
    }

    .file {
        border-top: 1px solid #ddd;
    }

    .folder-img {
        width: 30px;
        margin-right: 10px;
    }

    .file-img {
        width: 20px;
        margin-right: 10px;
    }

    .file a {
        color: #6980cd;
    }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

    <?php
        $file = $_FILES['file'];
        $zip = new ZipArchive;
        $dir = __dir__ . '/uploads/';
        $filename = time();
        if ($zip->open($file['tmp_name'])) {
            $zip->extractTo($dir . $filename);
            $zip->close();
        }

        function getDirList($dir, $filename) {
            $html = '<ul class="list">';
            $currentDir = $dir . $filename;
            $list = array_diff(scandir($currentDir), ['..', '.']);

            foreach ($list as $rs) {
                if (is_dir($currentDir . '/' . $rs)) {
                    $html .= "
                        <li>
                            <span class='folder'>
                                <img src='folder.png' class='folder-img' alt='folder'>
                                {$rs}
                            </span>
                        </li>
                    ";
                    $html .= getDirList($currentDir . '/', $rs);
                } else {
                    $link = ltrim(str_replace(__dir__, '', $currentDir . '/' . $rs), '/');
                    $html .= "
                        <li class='file'>
                            <img src='file.png' class='file-img' alt='file'>
                            <a href='{$link}' download=''>{$rs}</a>
                        </li>
                    ";
                }
            }

            $html .= '</ul>';

            return $html;
        }

        $html = getDirList($dir, $filename);
    ?>

    <div class="uploader">
        <h2 class="uploader-title"><?php echo $file['name']; ?> (<?php echo number_format($file['size'] / 1024 / 1024, 2); ?>MB)</h2>
        <?php echo $html; ?>
<!--        <ul class="list">-->
<!--            <span class="folder">-->
<!--                <img src="folder.png" class="folder-img" alt="folder">-->
<!--                css-->
<!--            </span>-->
<!--            <ul class="list">-->
<!--                <li class="file">-->
<!--                    <img src="file.png" class="file-img" alt="file">-->
<!--                    <a href="/uploads/bulma-0.7.4/css/bulma.css" download="">bulma.css</a>-->
<!--                </li>-->
<!--                <li class="file">-->
<!--                    <img src="file.png" class="file-img" alt="file">-->
<!--                    <a href="/uploads/bulma-0.7.4/css/bulma.css.map" download="">bulma.css.map</a>-->
<!--                </li>-->
<!--                <li class="file">-->
<!--                    <img src="file.png" class="file-img" alt="file">-->
<!--                    <a href="/uploads/bulma-0.7.4/css/bulma.min.css" download="">bulma.min.css</a>-->
<!--                </li>-->
<!--            </ul><span class="folder">-->
<!--                <img src="folder.png" class="folder-img" alt="folder">-->
<!--                sass-->
<!--            </span>-->
<!--            <ul class="list"><span class="folder">-->
<!--                    <img src="folder.png" class="folder-img" alt="folder">-->
<!--                    base-->
<!--                </span>-->
<!--                <ul class="list">-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/base/_all.sass" download="">_all.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/base/generic.sass" download="">generic.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/base/helpers.sass" download="">helpers.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/base/minireset.sass" download="">minireset.sass</a>-->
<!--                    </li>-->
<!--                </ul><span class="folder">-->
<!--                    <img src="folder.png" class="folder-img" alt="folder">-->
<!--                    components-->
<!--                </span>-->
<!--                <ul class="list">-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/components/_all.sass" download="">_all.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/components/breadcrumb.sass" download="">breadcrumb.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/components/card.sass" download="">card.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/components/dropdown.sass" download="">dropdown.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/components/level.sass" download="">level.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/components/list.sass" download="">list.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/components/media.sass" download="">media.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/components/menu.sass" download="">menu.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/components/message.sass" download="">message.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/components/modal.sass" download="">modal.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/components/navbar.sass" download="">navbar.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/components/pagination.sass" download="">pagination.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/components/panel.sass" download="">panel.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/components/tabs.sass" download="">tabs.sass</a>-->
<!--                    </li>-->
<!--                </ul><span class="folder">-->
<!--                    <img src="folder.png" class="folder-img" alt="folder">-->
<!--                    elements-->
<!--                </span>-->
<!--                <ul class="list">-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/elements/_all.sass" download="">_all.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/elements/box.sass" download="">box.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/elements/button.sass" download="">button.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/elements/container.sass" download="">container.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/elements/content.sass" download="">content.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/elements/form.sass" download="">form.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/elements/icon.sass" download="">icon.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/elements/image.sass" download="">image.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/elements/notification.sass" download="">notification.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/elements/other.sass" download="">other.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/elements/progress.sass" download="">progress.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/elements/table.sass" download="">table.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/elements/tag.sass" download="">tag.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/elements/title.sass" download="">title.sass</a>-->
<!--                    </li>-->
<!--                </ul><span class="folder">-->
<!--                    <img src="folder.png" class="folder-img" alt="folder">-->
<!--                    grid-->
<!--                </span>-->
<!--                <ul class="list">-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/grid/_all.sass" download="">_all.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/grid/columns.sass" download="">columns.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/grid/tiles.sass" download="">tiles.sass</a>-->
<!--                    </li>-->
<!--                </ul><span class="folder">-->
<!--                    <img src="folder.png" class="folder-img" alt="folder">-->
<!--                    layout-->
<!--                </span>-->
<!--                <ul class="list">-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/layout/_all.sass" download="">_all.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/layout/footer.sass" download="">footer.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/layout/hero.sass" download="">hero.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/layout/section.sass" download="">section.sass</a>-->
<!--                    </li>-->
<!--                </ul><span class="folder">-->
<!--                    <img src="folder.png" class="folder-img" alt="folder">-->
<!--                    utilities-->
<!--                </span>-->
<!--                <ul class="list">-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/utilities/_all.sass" download="">_all.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/utilities/animations.sass" download="">animations.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/utilities/controls.sass" download="">controls.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/utilities/derived-variables.sass"-->
<!--                            download="">derived-variables.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/utilities/functions.sass" download="">functions.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/utilities/initial-variables.sass"-->
<!--                            download="">initial-variables.sass</a>-->
<!--                    </li>-->
<!--                    <li class="file">-->
<!--                        <img src="file.png" class="file-img" alt="file">-->
<!--                        <a href="/uploads/bulma-0.7.4/sass/utilities/mixins.sass" download="">mixins.sass</a>-->
<!--                    </li>-->
<!--                </ul>-->
<!--                <li class="file">-->
<!--                    <img src="file.png" class="file-img" alt="file">-->
<!--                    <a href="/uploads/bulma-0.7.4/sass/.DS_Store" download="">.DS_Store</a>-->
<!--                </li>-->
<!--            </ul>-->
<!--            <li class="file">-->
<!--                <img src="file.png" class="file-img" alt="file">-->
<!--                <a href="/uploads/bulma-0.7.4/CHANGELOG.md" download="">CHANGELOG.md</a>-->
<!--            </li>-->
<!--            <li class="file">-->
<!--                <img src="file.png" class="file-img" alt="file">-->
<!--                <a href="/uploads/bulma-0.7.4/LICENSE" download="">LICENSE</a>-->
<!--            </li>-->
<!--            <li class="file">-->
<!--                <img src="file.png" class="file-img" alt="file">-->
<!--                <a href="/uploads/bulma-0.7.4/README.md" download="">README.md</a>-->
<!--            </li>-->
<!--            <li class="file">-->
<!--                <img src="file.png" class="file-img" alt="file">-->
<!--                <a href="/uploads/bulma-0.7.4/bulma.sass" download="">bulma.sass</a>-->
<!--            </li>-->
<!--            <li class="file">-->
<!--                <img src="file.png" class="file-img" alt="file">-->
<!--                <a href="/uploads/bulma-0.7.4/package.json" download="">package.json</a>-->
<!--            </li>-->
<!--        </ul>-->
    </div>

</body>
</html>