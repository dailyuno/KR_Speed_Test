<?php
/**
 * Plugin Name: CountDown Kazan WorldSkills
 */
class CountDown extends \WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'countdown_kazan_worldskills',
            'Countdown Kazan WorldSkills'
        );
    }

    public function widget($args, $instance)
    {
        ?>
            <section class="widget-section">
                <h2>CountDown KAzan WorldSkills</h2>
                <div id="timer">
                    <div class="group">
                        <h3 id="days"></h3>
                        <h5>days</h5>
                    </div>
                    <div class="group">
                        <h3 id="hours"></h3>
                        <h5>hours</h5>
                    </div>
                    <div class="group">
                        <h3 id="minutes"></h3>
                        <h5>minutes</h5>
                    </div>
                    <div class="group">
                        <h3 id="seconds"></h3>
                        <h5>seconds</h5>
                    </div>
                </div>
            </section>

            <style>
                #timer {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    margin-bottom: 30px;
                }

                #timer .group {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    flex-direction: column;
                }

                #timer .group h3 {
                    margin: 0;
                }
            </style>

            <script>
                (function($){
                    function setTimer() {
                        const d1 = new Date();
                        const d2 = new Date(2019, 7, 22);
                        const secondsTime = 1000;
                        const minutesTime = secondsTime * 60;
                        const hoursTime = minutesTime * 60;
                        const daysTime = hoursTime * 24;

                        let diff = d2 - d1;

                        const days = Math.floor(diff / daysTime);

                        diff -= days * daysTime;

                        const hours = Math.floor(diff / hoursTime);

                        diff -= hours * hoursTime;

                        const minutes = Math.floor(diff / minutesTime);

                        diff -= minutes * minutesTime;

                        const seconds = Math.floor(diff / secondsTime);

                        $("#days").html(days);
                        $("#hours").html(hours);
                        $("#minutes").html(minutes);
                        $("#seconds").html(seconds);
                    }

                    setTimer();

                    setInterval(_ => {
                        setTimer();
                    }, 1000);
                })(jQuery);
            </script>
        <?php
    }
}

add_action('widgets_init', function(){
    register_widget('CountDown');
});