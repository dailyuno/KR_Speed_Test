<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="calendar.css">
</head>
<body>

    <?php
        class Calendar {
            private $enMonths = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

            public function __construct($date)
            {
                $this->d = $date;
                $this->time = strtotime($date);
                $this->date = date_create($date);
                $this->year = date_format($this->date, 'Y');
                $this->month = date_format($this->date, 'm');
                $this->enMonth = $this->enMonths[(int)$this->month - 1];
                $this->startDay = date_format($this->date, 'w');
                $this->lastDay = date_format($this->date, 't');
                $this->total = ceil(($this->startDay + $this->lastDay) / 7);
            }

            public function getTable()
            {
                for ($i = 0; $i < $this->total; $i++) {
                    echo '<div class="fc-row">';

                    for ($j = 0; $j < 7; $j++) {
                        $date = $i * 7 + $j - $this->startDay + 1;
                        $day = '';
                        if ($date > 0 && $date <= $this->lastDay) $day = $date;

                        if ((int)date('Y') == $this->year && (int)date('m') == $this->month && (int)date('d') == $date) {
                            echo '<div class="fc-today">';
                        } else {
                            echo '<div>';
                        }
                        echo '<span class="fc-date">' . $day  . '</span>';
                        echo '</div>';
                    }

                    echo '</div>';
                }
            }

            public function prevMonth()
            {
                $d = date_create($this->d);
                date_sub($d, date_interval_create_from_date_string('1 months'));
                return date_format($d, 'Y-m');
            }

            public function nextMonth()
            {
                $d = date_create($this->d);
                date_add($d, date_interval_create_from_date_string('1 months'));
                return date_format($d, 'Y-m');
            }
        }

        $date = isset($_GET['date']) ? $_GET['date'] : date('Y-m');
        $calendar = new Calendar($date);
    ?>

    <div class="custom-calendar-wrap">
        <div class="custom-inner">
            <div class="custom-header clearfix">
                <nav>
                    <a href="?date=<?php echo $calendar->prevMonth(); ?>" class="custom-btn custom-prev"></a>
                    <a href="?date=<?php echo $calendar->nextMonth(); ?>" class="custom-btn custom-next"></a>
                </nav>
                <h2 id="custom-month" class="custom-month"><?php echo $calendar->enMonth; ?></h2>
                <h3 id="custom-year" class="custom-year"><?php echo $calendar->year; ?></h3>
            </div>
            <div id="calendar" class="fc-calendar-container">
                <div class="fc-calendar fc-five-rows">
                    <div class="fc-head">
                        <div>Sun</div>
                        <div>Mon</div>
                        <div>Tue</div>
                        <div>Wed</div>
                        <div>Thu</div>
                        <div>Fri</div>
                        <div>Sat</div>
                    </div>
                    <div class="fc-body">
                        <?php echo $calendar->getTable(); ?>
<!--                        <div class="fc-row">-->
<!--                            <div><span class="fc-date"></span></div>-->
<!--                            <div><span class="fc-date"></span></div>-->
<!--                            <div><span class="fc-date"></span></div>-->
<!--                            <div><span class="fc-date"></span></div>-->
<!--                            <div><span class="fc-date"></span></div>-->
<!--                            <div><span class="fc-date">1</span></div>-->
<!--                            <div><span class="fc-date">2</span></div>-->
<!--                        </div>-->
<!--                        <div class="fc-row">-->
<!--                            <div><span class="fc-date">3</span></div>-->
<!--                            <div><span class="fc-date">4</span></div>-->
<!--                            <div><span class="fc-date">5</span></div>-->
<!--                            <div><span class="fc-date">6</span></div>-->
<!--                            <div><span class="fc-date">7</span></div>-->
<!--                            <div><span class="fc-date">8</span></div>-->
<!--                            <div><span class="fc-date">9</span></div>-->
<!--                        </div>-->
<!--                        <div class="fc-row">-->
<!--                            <div><span class="fc-date">10</span></div>-->
<!--                            <div><span class="fc-date">11</span></div>-->
<!--                            <div><span class="fc-date">12</span></div>-->
<!--                            <div><span class="fc-date">13</span></div>-->
<!--                            <div><span class="fc-date">14</span></div>-->
<!--                            <div><span class="fc-date">15</span></div>-->
<!--                            <div><span class="fc-date">16</span></div>-->
<!--                        </div>-->
<!--                        <div class="fc-row">-->
<!--                            <div><span class="fc-date">17</span></div>-->
<!--                            <div><span class="fc-date">18</span></div>-->
<!--                            <div><span class="fc-date">19</span></div>-->
<!--                            <div><span class="fc-date">20</span></div>-->
<!--                            <div><span class="fc-date">21</span></div>-->
<!--                            <div><span class="fc-date">22</span></div>-->
<!--                            <div><span class="fc-date">23</span></div>-->
<!--                        </div>-->
<!--                        <div class="fc-row">-->
<!--                            <div><span class="fc-date">24</span></div>-->
<!--                            <div class="fc-today"><span class="fc-date">25</span></div>-->
<!--                            <div><span class="fc-date">26</span></div>-->
<!--                            <div><span class="fc-date">27</span></div>-->
<!--                            <div><span class="fc-date">28</span></div>-->
<!--                            <div><span class="fc-date"></span></div>-->
<!--                            <div><span class="fc-date"></span></div>-->
<!--                        </div>-->
                    </div>
                </div>
            </div>
        </div>


</body>

</html>