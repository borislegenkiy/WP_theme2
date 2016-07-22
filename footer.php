<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package life-haker
 */
?>
	</main>
	</div>
	</div>
	</div>

	<footer class="footer">
	<div class="footer_line1">
		<div class="footer_content_line1">
			<div class="footer_block1 f_left">
				<div class="foter_links_line1">
					<span class="footer_block_header">Сотрудничество</span>
					<span class="footer_block_links"><span class="seolink" rel="/nash-avtor" title="Станьте нашим автором">Станьте нашим автором</span></span>
					<span class="footer_block_links"><span class="seolink" rel="/reklama-na-sajte" title="Реклама на сайте">Реклама на сайте</a></span>
				</div>
			</div>
			<div class="footer_block2 f_left">
				<div class="foter_links_line1">
					<span class="footer_block_header">О проекте</span>
					<span class="footer_block_links"><span class="seolink" rel="http://lifeha.ru/" title="Главная">Главная</span></span>
					<span class="footer_block_links"><span class="seolink" rel="/raspisanye" title="Расписание">Расписание</span></span>
					<span class="footer_block_links"><span class="seolink" rel="/kursy" title="Магазин курсов">Магазин курсов</span></span>
					<span class="footer_block_links"><span class="seolink" rel="/free2" title="Бесплатные курсы">Бесплатные курсы</span></span>
					<?php if ($_SERVER['REDIRECT_URL']=='') {?>
						<span class="footer_block_links"><a href="/sitemap">Карта сайта</a></span>
					<?php } else {?>
						<span class="footer_block_links"><span  class="seolink" rel="/sitemap" title="Карта сайта">Карта сайта</span></span>
					<?php }?>
				</div>
			</div>
			<div class="footer_block3 f_left">
				<div class="foter_links_line1">
					<span class="footer_block_header">Присоединяйтесь</span>
					<span class="footer_block_links"><span class="seolink_target" rel="https://vk.com/lifehaonline" title="ВКонтакте" target="_blank">ВКонтакте</span></span>
					<span class="footer_block_links"><span class="seolink_target" rel="https://www.facebook.com/lifeha2/" title="Facebook" target="_blank">Facebook</span></span>
					<span class="footer_block_links"><span class="seolink_target" rel="https://www.youtube.com/user/lifeharu" title="Канал на YouTube c уроками" target="_blank">Канал на YouTube c уроками</span></span>
					<span class="footer_block_links"><span class="seolink_target" rel="https://www.youtube.com/user/lifehakru" title="Канал на YouTube c вебинарами" target="_blank">Канал на YouTube c вебинарами</span></span>
				</div>
			</div>
			<div class="footer_block4 f_left">
			</div>
		</div>
	</div>
	<div class="footer_line2">
		<div class="footer_content_line2">
			<div class="all_rights_reserved f_left">Зарегистрированная ТМ: Лафйхакер<br> &copy; 2012-2015</div>
			<div class="f_right">
				<div class="footer_line2_links_block f_left">
					<div class="footer_line2_links"><span class="seolink" rel="/sluzhba-podderzhki" title="Служба поддержки">Служба поддержки</span></div>
					<div class="footer_line2_links"><span class="seolink" rel="mailto:vip@tinvest.org" title="vip@tinvest.org">vip@tinvest.org</span></div>
				</div>
				<div class="footer_line2_links_block f_left">
					<div class="footer_line2_links"><span class="seolink" rel="/soglashenie" title="Соглашение об обработке персональных данных">Соглашение об обработке персональных данных</span></div>
					<div class="footer_line2_links"><span class="seolink" rel="/otvetstvennost-za-pribyl" title="Снятие ответственности за прибыль или доход">Снятие ответственности за прибыль или доход</span></div>
				</div>
				<div class="footer_line2_links_block footer_line2_links f_left"><span class="seolink" rel="/dogovor-oferta" title="Договор-оферта">Договор-оферта</span></div>
			</div>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
