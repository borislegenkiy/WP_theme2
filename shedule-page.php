<h1><?php the_title();?></h1>
<? $i=1;?>
<?php query_posts('page_id=2062'); ?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
		
<? $spisok=get_field('trainer'); ?>
<div class="shedule_box">
<div class="content_place f_left">
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
		
	
		if ($year_current<=$year_event) {
			if ($month_current<=$month_event) {
				if ($day_current<$day_event) {?>
						<div class="shedule" onclick="window.open('<?php echo $spisok_iteam['href'];?>','_blank');">
							<table>
								<tr>
									<td class="shedule_img"><img width="94px" src="<? echo $spisok_iteam['photo']['sizes']['thumbnail'];?>" alt="<?php echo $spisok_iteam['event'];?> - Лайфха" title="<?php echo $spisok_iteam['event'];?> - Лайфха"></td>
									<td class="shedule_date"><?php echo $spisok_iteam['date'];?></td>
									<td class="shedule_time"><?php echo $spisok_iteam['time'];?></td>
									<td class="shedule_vebinar"><?php echo $spisok_iteam['event'];?></td>
								</tr>
							</table>
						</div>
				<?} else {
					if ($day_current==$day_event) {
						if ($hour_current-4<$hour_event) {?>
								<div class="shedule" onclick="window.open('<?php echo $spisok_iteam['href'];?>','_blank');">
									<table>
										<tr>
											<td class="shedule_img"><img width="94px" src="<? echo $spisok_iteam['photo']['sizes']['thumbnail'];?>" alt="<?php echo $spisok_iteam['event'];?> - Лайфха" title="<?php echo $spisok_iteam['event'];?> - Лайфха"></td>
											<td class="shedule_date"><?php echo $spisok_iteam['date'];?></td>
											<td class="shedule_time"><?php echo $spisok_iteam['time'];?></td>
											<td class="shedule_vebinar"><?php echo $spisok_iteam['event'];?></td>
										</tr>
									</table>
								</div>
						<?} else {
							if ($minute_current<$minute_event) {?>
								<div class="shedule" onclick="window.open('<?php echo $spisok_iteam['href'];?>','_blank');">
									<table>
										<tr>
											<td class="shedule_img"><img width="94px" src="<? echo $spisok_iteam['photo']['sizes']['thumbnail'];?>" alt="<?php echo $spisok_iteam['event'];?> - Лайфха" title="<?php echo $spisok_iteam['event'];?> - Лайфха"></td>
											<td class="shedule_date"><?php echo $spisok_iteam['date'];?></td>
											<td class="shedule_time"><?php echo $spisok_iteam['time'];?></td>
											<td class="shedule_vebinar"><?php echo $spisok_iteam['event'];?></td>
										</tr>
									</table>
								</div>
							<?}
						}
					}
				}
			}
		}
	?>
	<? $i++;?>
<? } ?>
</div>
</div>
<?php endwhile;?>
<?php endif;?>
<?php wp_reset_query(); ?>
