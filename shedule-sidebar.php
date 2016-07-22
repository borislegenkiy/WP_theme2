<? $i=1;?>
<?php query_posts('page_id=2062'); ?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
		
<? $spisok=get_field('trainer'); ?>
<?php if (empty($spisok)) {?>
	<div class="category_header"><span class="fa fa-calendar"></span> Ближайшие события:</div>
<?php }?>
<div class="trainer_place">
<? foreach($spisok as $spisok_iteam){?>
<?php
		//date's of event
		$year_event = $spisok_iteam['full_date'][0].$spisok_iteam['full_date'][1].$spisok_iteam['full_date'][2].$spisok_iteam['full_date'][3];
		$month_event = $spisok_iteam['full_date'][4].$spisok_iteam['full_date'][5];
		$day_event = $spisok_iteam['full_date'][6].$spisok_iteam['full_date'][7];

		//current day
		$current_date = date("Ymd");
		$year_current = $current_date[0].$current_date[1].$current_date[2].$current_date[3];
		$month_current = $current_date[4].$current_date[5];
		$day_current = $current_date[6].$current_date[7];
		
		//event time
		$hour_event = $spisok_iteam['time'][0].$spisok_iteam['time'][1];
		$minute_event = $spisok_iteam['time'][3].$spisok_iteam['time'][4];
		
		//current time
		$hour_current = date("H")+3;
		$minute_current = date("i");
		
		//echo $day_event.":".$month_event.":".$year_event;
		//echo $day_current.":".$month_current.":".$year_current;
		if ($year_current<=$year_event) {
			if ($month_current<=$month_event) {
				if ($day_current<$day_event) {?>
					<div class="trainer" onclick="window.open('<?php echo $spisok_iteam['href'];?>','_blank');">						
                        <? /* <div class="trainer_img_place f_left">
                        <img width="70px" src="<? echo $spisok_iteam['photo']['sizes']['thumbnail'];?>" alt="<?php echo $spisok_iteam['event'];?> - Лайфха" title="<?php echo $spisok_iteam['event'];?> - Лайфха">
                        </div>
                        */ ?>
						<div class="trainer_text_place f_left">
							<div class="training_time_place"><?php echo $spisok_iteam['date'];?>&nbsp;<?php echo $spisok_iteam['time'];?></div>
							<div class="training_name_place"><?php echo $spisok_iteam['event'];?></div>
						</div>
					</div>
					
				
				<?}
			}
		}
	?>
	<? $i++;?>
<? } ?>
</div>
<?php endwhile;?>
<?php endif;?>
<?php wp_reset_query();?>