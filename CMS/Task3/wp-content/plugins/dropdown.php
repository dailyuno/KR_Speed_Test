<?php
/**
 * Plugin Name: Dropdown Menu
 */
function get_dropdown_menus() {
    global $wpdb;

    $menus = $wpdb->get_results('SELECT * FROM wp_dropdown_menus WHERE menuID IS NULL');

    foreach ($menus as $menu) {
        $menu->submenus = $wpdb->get_results('SELECT * FROM wp_dropdown_menus WHERE menuID = "' . $menu->id . '"');
    }

    return $menus;
}

add_action('admin_menu', function(){
    add_menu_page(
        'Dropdown Menu',
        'Dropdown Menu',
        1,
        'dropdown_menu_overview',
        function() {
            $menus = get_dropdown_menus();
            $url = admin_url('admin-post.php');
            ?>
                <style>
                    .dropdown-menus {
                        display: flex;
                    }

                    .dropdown-menus li {
                        margin-right: 20px;
                    }
                </style>

                <div class="wrap">
                    <h2>Dropdown Menu</h2>
                    <form action="<?php echo $url; ?>" method="POST">
                        <a href="<?php echo $url; ?>?action=dropdown_create_menu" class="button button-primary">Add Menu</a>
                        <button class="button button-primary">Save</button>
                        <input type="hidden" name="action" value="dropdown_save_menu">

                        <ul class="dropdown-menus">
                            <?php foreach ($menus as $menu){?>
                                <li>
                                    <input type="hidden" name="menuID[]" value="<?php echo $menu->id; ?>">
                                    <input type="text" name="name[]" value="<?php echo $menu->name; ?>">
                                    <a href="<?php echo $url; ?>?action=dropdown_remove_menu&id=<?php echo $menu->id; ?>" class="button button-default">&times;</a>
                                    <br>
                                    <a href="<?php echo $url; ?>?action=dropdown_create_submenu&id=<?php echo $menu->id; ?>" class="button button-default">Add SubMenu</a>
                                    <br>
                                    <hr>
                                    <ul>
                                        <?php foreach ($menu->submenus as $submenu){?>
                                            <li>
                                                <input type="hidden" name="menuID[]" value="<?php echo $submenu->id; ?>">
                                                <input type="text" name="name[]" value="<?php echo $submenu->name; ?>">
                                                <a href="<?php echo $url; ?>?action=dropdown_remove_menu&id=<?php echo $submenu->id; ?>" class="button button-default">&times;</a>
                                            </li>
                                        <?php }?>
                                    </ul>
                                </li>
                            <?php }?>
                        </ul>
                    </form>
                </div>
            <?php
        }
    );
});

add_action('admin_post_dropdown_create_menu', function(){
    global $wpdb;

    $wpdb->insert('wp_dropdown_menus', [
        'name' => 'default menu'
    ]);

    wp_redirect(wp_get_referer());
});

add_action('admin_post_dropdown_create_submenu', function(){
    global $wpdb;

    $wpdb->insert('wp_dropdown_menus', [
        'name' => 'default submenu',
        'menuID' => $_GET['id']
    ]);

    wp_redirect(wp_get_referer());
});

add_action('admin_post_dropdown_remove_menu', function(){
    global $wpdb;

    $wpdb->delete('wp_dropdown_menus', [
        'id' => $_GET['id']
    ]);

    wp_redirect(wp_get_referer());
});

add_action('admin_post_dropdown_save_menu', function(){
    global $wpdb;

    foreach ($_POST['menuID'] as $key => $menuID) {
        $wpdb->update('wp_dropdown_menus', [
            'name' => $_POST['name'][$key]
        ], [
            'id' => $menuID
        ]);
    }

    wp_redirect(wp_get_referer());
});

add_shortcode('dropdown_menu', function(){
    $menus = get_dropdown_menus();
    ?>
        <style>
            .dropdown-menus {
                display: flex;
            }

            .dropdown-menus,
            .dropdown-menus ul {
                list-style: none;
                margin: 0;
                padding: 0;
            }

            .dropdown-menus ul {
                position: absolute;
                display: none;
            }

            .dropdown-menus > li {
                margin-right: 20px;
            }

            .dropdown-menus div,
            .dropdown-menus ul li {
                width: 200px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: #007bfd;
                color: #fff;
                cursor: pointer;
            }

            .dropdown-menus-container {
                padding: 50px 0;
            }
        </style>

        <div class="dropdown-menus-container">
            <h2>Dropdown Menus</h2>
            <ul class="dropdown-menus">
                <?php foreach ($menus as $menu){?>
                    <li>
                        <div><?php echo $menu->name; ?></div>
                        <ul>
                            <?php foreach ($menu->submenus as $submenu){?>
                                <li><?php echo $submenu->name; ?></li>
                            <?php }?>
                        </ul>
                    </li>
                <?php }?>
            </ul>
        </div>

        <script>
            (function($){
                $('.dropdown-menus > li').on('mouseover', function(){
                    $(this).find('ul').stop().slideDown();
                });

                $('.dropdown-menus > li').on('mouseout', function(){
                    $(this).find('ul').stop().slideUp();
                });
            })(jQuery);
        </script>
    <?php
});