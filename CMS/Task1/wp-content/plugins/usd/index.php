<?php
/**
 * Plugin Name: Currency exchange rate.
 */
class CurrencyRate extends \WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'currency_exchange_rate',
            'Currency exchange Rate'
        );
    }

    public function widget($args, $instance)
    {
            $usd = json_decode(file_get_contents(__dir__ . '/usd.json'));
        ?>
            <section class="widget-section">
                <h2 class="widget-title">Currency Rate</h2>
                <ul>
                    <?php foreach ($usd as $rs){?>
                        <li>
                            <h5><?php echo $rs->name; ?></h5>
                            <p><?php echo $rs->rate; ?> (<?php echo $rs->code; ?>)</p>
                        </li>
                    <?php }?>
                </ul>
            </section>
        <?php
    }
}

add_action('widgets_init', function(){
    register_widget('CurrencyRate');
});