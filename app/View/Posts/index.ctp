<div class="users index">


	<h2><?php echo __('トップ'); ?></h2>
    <div class="seach">
    <hr />
    
<!-- 使用しない
	<?php echo $this->Form->create('Post'); ?>
	<table cellpadding="0" cellspacing="0">
    <h4><?php echo __('メール送信'); ?></h4>
    	<?php
		$option = array('value' => array('day' => date('d'), 'month' => date('m'), 'year' => date('Y')));
		echo $this->Form->dateTime(
				'from_date', 
				'YMD', 
				null, 
				array(
					'empty' => false,
					'minYear' => 2010,
					'maxYear' => date('Y'),
					'interval' => 0,
					'monthNames' => false,
					'separator' => ' / ',
					'default' => date('Y-M-D')
				)
		);
		?>&nbsp;&nbsp;～&nbsp;&nbsp;
        <?php
		echo $this->Form->dateTime(
				'to_date', 
				'YMD', 
				null, 
				array(
					'empty' => false,
					'minYear' => 2010,
					'maxYear' => date('Y'),
					'interval' => 0,
					'monthNames' => false,
					'separator' => ' / ',
					'default' => date('Y-M-D')
				)
		);
        ?>&nbsp;&nbsp;<?php echo $this->Form->postButton('送信', array('action' => 'index')); ?>
    </table>
    <hr />
 -->
	
    <h4><?php echo __('予約状況'); ?></h4>
    <form method="get" action="/rms/index.php/posts">
    <table>
    	<tr>
    		<td>
    			<?php
    				// 選択した店舗が保持された状態にする
    				if($selected_tenpo_disp_mode != null){
    					echo $this->Form->input('tenpo_name', array('label'=>'店舗', 'type'=>'select', 'options'=> $tenpos, 'div'=>false, 'onchange'=>'submit(this.form)', 'selected'=>$selected_tenpo_disp_mode['data']['tenpo_name']));
    				// ただし、ログイン直後は、所属店舗が選択された状態にする
    				}else{
    					echo $this->Form->input('tenpo_name', array('label'=>'店舗', 'type'=>'select', 'options'=> $tenpos, 'div'=>true, 'onchange'=>'submit(this.form)', 'selected'=>$_SESSION['Auth']['User']['tenpo_id']));
    				}
    			?>
    		</td>
    		<td>
    			<?php $ary_disp_modes = array('時間表示', '週表示', '月表示'); ?>
    			<?php
    				// 選択した[表示モード]が保持された状態にする
    				if($selected_tenpo_disp_mode != null){
    					echo $this->Form->input('disp_mode', array('label'=>'表示モード', 'type'=>'select', 'options'=>$ary_disp_modes, 'div'=>false, 'onchange'=>'submit(this.form)', 'selected'=>$selected_tenpo_disp_mode['data']['disp_mode']));
    				// ただし、ログイン直後の表示モードは、「本日」とする
    				}else{
    					echo $this->Form->input('disp_mode', array('label'=>'表示モード', 'type'=>'select', 'options'=>$ary_disp_modes, 'div'=>false, 'onchange'=>'submit(this.form)', 'selected'=>'0'));
    				} 
    			?>
    		</td>
    		<td>
    			<?php
    				// [<<前]ボタン、[本日]ボタン、[次>>]ボタンを出力
    				foreach($array_button_label as $key => $value){
    					echo $this->Form->button($value, array('name'=>$key, 'value'=>$key, 'options'=>$key, 'div'=>false, 'onclick'=>'submit(this.form)'));
    				}
    			?>
    		</td>
    	</tr>
    </table>
    </form>
    
    
    <div style="overflow-y:scroll; overflow-x:scroll;">
    <table>
    	<tr>
    		<?php 
    		// 初期表示、または[表示モード]が「本日」の場合
    		if($selected_tenpo_disp_mode == null || $selected_tenpo_disp_mode['data']['disp_mode'] == 0){
    			
    			$_SESSION['Auth']['User']['displayed_flag'] = 0;
    			
    			// セッション情報内の日付を、クリックしたボタンに応じて設定
    			// ①画面初期表示時、または[本日]ボタンクリック時
    			if((!isset($selected_tenpo_disp_mode['-1']) && !isset($selected_tenpo_disp_mode['1'])) || isset($selected_tenpo_disp_mode['0'])){
    				$_SESSION['Auth']['User']['click_cnt'] = 0;
    				$_SESSION['Auth']['User']['disp_now_day'] = date('Y-m-d');
    			}else{
    				// 1日をUNIX時で表した定数
    				define('ONE_DAY', 86400);
    				
    				// セッション情報内の日付を、いったんUNIX時に変換
					list($chk_year, $chk_month, $chk_day) = explode('-', $_SESSION['Auth']['User']['disp_now_day']);
					$unix_date = mktime(0, 0, 0, $chk_month, $chk_day, $chk_year);
    			
    				// ②[<<前]ボタンクリック時
					if(isset($selected_tenpo_disp_mode['-1'])){
						$_SESSION['Auth']['User']['click_cnt'] = 1;
						
						// 1日マイナスする
						$unix_date -= ONE_DAY;
					}
					// ③[後>>]ボタンクリック時
					if(isset($selected_tenpo_disp_mode['1'])){
						$_SESSION['Auth']['User']['click_cnt'] = 1;
						
						// 1日プラスする
						$unix_date += ONE_DAY;
					}
					
					// UNIX時を「Y-m-d」書式に変換し、セッション情報に戻す
					$_SESSION['Auth']['User']['disp_now_day'] = date('Y-m-d', $unix_date);
					
    			}
    			
    			echo $_SESSION['Auth']['User']['disp_now_day'].'の予約情報です。</br>';
    			
    			// 空セルを出力
    			echo '<th>&nbsp;</th>';
    			
    			// ここから、時刻セルを出力
    			// ①24時間営業の場合
    			if($tenpo_time_tables[0]['TenpoM']['twenty_four_flg'] == 1){
    				// 午前6:00～翌日午前5;00までのセルを作成
    				for($i=0; $i<24; $i++){
    					$j = $i+6;
    					if($j>=24){
    						$j = $j-24;
    					}
    					echo '<th colspan="2">' .$j.':00</th>';
    				}
    			// ②24時間営業ではない場合
    			}else{
    				// 開店時間から、「時」を取得
    				$ary_kaiten_time = explode(':', $tenpo_time_tables[0]['TenpoM']['kaiten_time']);
    				// 閉店時間から、「時」を取得
    				$ary_heiten_time = explode(':', $tenpo_time_tables[0]['TenpoM']['heiten_time']);
    				// 閉店時間が「0時より前」の場合
    				if($ary_kaiten_time[0] < $ary_heiten_time[0]){
    					for($i=$ary_kaiten_time[0]; $i<$ary_heiten_time[0]; $i++){
    						echo '<th colspan="2">' .$i.':00</th>';
    					}
    				// 閉店時間が「0時以降」の場合
    				}else{
    					for($i=$ary_kaiten_time[0]; $i<=$ary_heiten_time[0]+24; $i++){
    						if($i>=24){
    							$j = $i - 24;
    							echo '<th colspan="2">' .$j.':00</th>';
    						}else{
    							echo '<th colspan="2">' .$i.':00</th>';
    						}
    					}
    				}
    			}
    			// 時刻行の出力終了
    			echo '</tr>';
    					
    			// 各座席ごとの行を生成
    			foreach($tenpo_zasekis as $key => $value){
    				echo '<tr>';
    				echo '<th>';
    				echo $tenpo_time_tables[0]['ZasekiM'][$key]['name'];
    				echo '</th>';
    				
    				// 当日の予約情報があれば、表示用の予約情報を作成
    				if($yoyaku_jyoho_list != null){
    					
    					$zaseki_names = array();
    					
    					// 予約した座席名を取得し、「氏名」「予約日」「来店時間」「退店時間」を結びつける
    					for($i=0; $i<count($yoyaku_jyoho_list); $i++){
    						
    						// $yoyaku_jyoho_list[$i]['YoyakuJyoho']['zaseki']内の文字数を取得
    						$ary_yoyaku_zaseki_length[$i] = mb_strlen($yoyaku_jyoho_list[$i]['YoyakuJyoho']['zaseki']);
    					
    						// $yoyaku_jyoho_list[$i]['YoyakuJyoho']['zaseki']内の文字列から、最後の「,」を除去した文字列を取得
    						$ary_yoyaku_zasekis[$i] = mb_substr($yoyaku_jyoho_list[$i]['YoyakuJyoho']['zaseki'], 0, $ary_yoyaku_zaseki_length[$i]-1);
    					
    						// $ary_yoyaku_zasekis[$i]内の文字列から「,」を除去して、個々の座席名を取得
    						$zaseki_names = explode(',', $ary_yoyaku_zasekis[$i]);
    						
    						for($j=0; $j<count($zaseki_names); $j++){
    							// 「座席」「氏名」「予約日」「来店時間」「退店時間」を結びつけて、表示用の予約情報を作成
    						    $disp_yoyaku_jyoho[$i][$j] = array('zaseki' => $zaseki_names[$j],
    						    						   		'user_name' => $yoyaku_jyoho_list[$i]['YoyakuJyoho']['user_name'],
    													   		'yoyaku_day' => $yoyaku_jyoho_list[$i]['YoyakuJyoho']['yoyaku_day'],
    													   		'raiten_time' => $yoyaku_jyoho_list[$i]['YoyakuJyoho']['raiten_time'],
    													   		'taiten_time' => $yoyaku_jyoho_list[$i]['YoyakuJyoho']['taiten_time']);
    						}
    						
    					}
    					
    				}
    				
    				// 当日の予約情報があれば、以下の情報を取得する
    				// ①来店時間から、「時」と「分」を取得
    				// ②退店時間から、「時」と「分」を取得
    				// ③予約情報から、「座席」を取得
    				if(isset($disp_yoyaku_jyoho)){
    				
    					$raiten_time_list = array();
    					$taiten_time_list = array();
    					$raiten_zaseki_list = array();
    					
    					// 来店時間と退店時間から、「時」と「分」を取得
    					for($i=0; $i<count($disp_yoyaku_jyoho); $i++){
    						for($j=0; $j<count($disp_yoyaku_jyoho[$i]); $j++){
    							// 来店時間
    							$raiten_time_list[] = explode(':', $disp_yoyaku_jyoho[$i][$j]['raiten_time']);
    							// 退店時間
    							$taiten_time_list[] = explode(':', $disp_yoyaku_jyoho[$i][$j]['taiten_time']);
    							// 座席
    							$raiten_zaseki_list[] = $disp_yoyaku_jyoho[$i][$j]['zaseki'];
    						}
    					}
    				}
    				
    				// ①24時間営業ではない場合
    				if($tenpo_time_tables[0]['TenpoM']['twenty_four_flg'] == 0){
    					// 開店時間から、「時」を取得
    					$ary_kaiten_time = explode(':', $tenpo_time_tables[0]['TenpoM']['kaiten_time']);
    					// 閉店時間から、「時」を取得
    					$ary_heiten_time = explode(':', $tenpo_time_tables[0]['TenpoM']['heiten_time']);
    			
    					$disp_cell_flg = array();
    			
    					// 閉店時間が「0時より前」の場合
    					if($ary_kaiten_time[0] < $ary_heiten_time[0]){
    						// 開店時間～閉店時間までのセルを作成
    						for($i=$ary_kaiten_time[0]; $i<$ary_heiten_time[0]; $i++){
    							
    							if(isset($raiten_time_list)){
    								// 現状、予約情報内の来店時間のみ、セルの背景色を変えた状態
    								if($i == $raiten_time_list[0][0] && $raiten_zaseki_list[0] == $tenpo_time_tables[0]['ZasekiM'][$key]['name']){
    									echo '<td style="background:#ff0000; border:none">&nbsp;</td>';
    									echo '<td style="background:#ff0000; border:none">&nbsp;</td>';
    									$_SESSION['Auth']['User']['displayed_flag'] = 1;
    								}else{
    									echo '<td style="border:none">&nbsp;</td>';
    									echo '<td style="border:none">&nbsp;</td>';
    								}
    								
    							// 当日の予約情報がなければ、空セルを出力
    							}else{
    								echo '<td style="border:none">&nbsp;</td>';
    								echo '<td style="border:none">&nbsp;</td>';
    							}
    						}
    					
    					// 閉店時間が「0時以降」の場合
    					}else{
    						for($i=$ary_kaiten_time[0]; $i<=$ary_heiten_time[0]+24; $i++){
    							echo '<td>&nbsp;</td>';
    							echo '<td>&nbsp;</td>';
    						}
    					}
    				// ②24時間営業の場合
    				}else{
    					for($i=0; $i<24; $i++){
    					/*	$j = $i+6;
    						if($j>=24){
    							$j = $j-24;
    						}	*/
    						echo '<td>&nbsp;</td>';
    						echo '<td>&nbsp;</td>';
    					}
    				}
    				echo '</tr>';
    			}
    		?>
    		<?php
    		// [表示モード]を「週表示」にした場合
    		}else if($selected_tenpo_disp_mode['data']['disp_mode'] == 1){
    			// 「本日」を取得
    			function getToday($date = 'Y-m-d'){
    				$today = new DateTime();
    				return $today->format($date);
    			}
    			
    			// 「本日」かどうかをチェック
    			function isToday($year, $month, $day){
    				$today = getToday('Y-n-j');
    				
    				if($today == $year.'-'.$month.'-'.$day){
    					return true;
    				}
    				return false;
    			}
    			
    			// 今週の日曜日の日付を返す
    			function getSunday(){
    				$today = new DateTime();
    				$w = $today->format('w');
    				$ymd = $today->format('Y-m-d');
    				
    				$next_prev = new DateTime($ymd);
    				$next_prev->modify("-{$w} day");
    				return $next_prev->format('Ymd');
    			}
    			
    			// 今週の月曜日の日付を返す
    			function getMonday(){
    				$today = new DateTime();
    				$w = $today->format('w');
    				$ymd = $today->format('Y-m-d');
    				
    				if($w == 0){
    					$d = 6;
    				}else{
    					$d = $w - 1;
    				}
    				
    				$next_prev = new DateTime($ymd);
    				$next_prev->modify("-{$d} day");
    				return $next_prev->format('Ymd');
    			}
    			
    			function getNthDay($year, $month, $day, $n){
    				$next_prev = new DateTime($year.'-'.$month.'-'.$day);
    				$next_prev->modify($n);
    				return $next_prev->format('Ymd');
    			}
    			
    			// 表示する週間カレンダー用データを生成
    			if(isset($_GET['date'])){
    				// 年月日取得
    				$year_month_day = $_GET['date'];
    			}else{
    				// 今週日曜日を取得
    				$year_month_day = getSunday();
    			}
    			
    			// 現在の「日」セル用背景色
				$today_col_bg_color = '#FFFF99';
    			
    			// 年月日に変数で取得
    			$year = substr($year_month_day, 0, 4);
    			$month = substr($year_month_day, 4, 2);
    			$day = substr($year_month_day, 6, 2);
    			
    			$month = sprintf('%01d', $month);
    			$day = sprintf('%01d', $day);
    			
    			$next_week = getNthDay($year, $month, $day, '+1 week');
    			$pre_week = getNthDay($year, $month, $day, '-1 week');
    			
    			$table = null;
    			// 週間の日付を出力
    			for($i=0; $i<7; $i++){
    				$ymd = getNthDay($year, $month, $day, '+'.$i.'day');
    				$y = substr($ymd, 0, 4);
    				$m = substr($ymd, 4, 2);
    				$d = substr($ymd, 6, 2);
    				$n = sprintf('%01d', $m);
    				$j = sprintf('%01d', $d);
    				$t = $j.'日';
    				
    				if(isToday($y, $n, $j)){
    					// 本日の日付セルに、背景色を設定する
    					$table .= '<td style="background:' . $today_col_bg_color . '">' . $t . '</td>'. PHP_EOL;
    				}else{
    					$table .= '<td>'.$t.'</td>'.PHP_EOL;
    				}
    				
    				// 「土曜日」の日付セルまで出力後、改行
    				if($i == 6) {
        				$table .= '</tr>';
        				// 「予約情報」を表示するセル行（1日あたり4行）を設定
        				for($a=1; $a<=4; $a++){
        					$table .= '<tr>';
        					for($b=1; $b<=7; $b++){
        						$table .= '<td style="border:none">&nbsp;</td>';
        					}
        					$table .= '</tr>';
        				}
    				}
    				
    			}
    			
    			// 「曜日」を見出しとする
    			echo '<th>日</th><th>月</th><th>火</th><th>水</th><th>木</th><th>金</th><th>土</th></tr>';
    			// 「日付行」と「予約情報（4行）」を出力
    			echo '<tr>';
    			echo $table;
    			echo '</tr>';
    		// [表示モード]を「月表示」にした場合
    		}else if($selected_tenpo_disp_mode['data']['disp_mode'] == 2){
    		
    			// 予約日と同じ日付であれば、背景色を返すメソッド
    			function dispCellBackground($i, $yoyaku_day){
    				for($m=0; $m<count($yoyaku_day); $m++){
    					if($i == $yoyaku_day[$m][2]){
    						return 'background:#ff0000; ';
    					}else{
    						return '';
    					}
    				}
    			}
    		
    			// 予約日と同じ日付であれば、お客様名を返すメソッド
    			function dispYoyakuName($i, $yoyaku_day, $yoyaku_name, $first){
    				for($m=0; $m<count($yoyaku_day); $m++){
    					if($i == $yoyaku_day[$m][2]){
    						return $yoyaku_name[$m];
    					}else{
    						return '&nbsp;';
    					}
    				}
    			}
    		
    		
    			// 「曜日」を見出しとする
    			echo '<th>日</th><th>月</th><th>火</th><th>水</th><th>木</th><th>金</th><th>土</th></tr>';
    			
    			// ①画面初期表示時、または[本日]ボタンクリック時
    			if((!isset($selected_tenpo_disp_mode['-1']) && !isset($selected_tenpo_disp_mode['1'])) || isset($selected_tenpo_disp_mode['0'])){
    				// 現在の日付（セッション情報内の日付）を分割し、「年」「月」「日」の各変数に代入
					list($year, $month, $day) = explode('-', $_SESSION['Auth']['User']['disp_now_day']);
    			}else{
    				// セッション情報内の日付を、いったんUNIX時に変換
					list($now_year, $now_month, $now_day) = explode('-', $_SESSION['Auth']['User']['disp_now_day']);
					$now_unix_date = mktime(0, 0, 0, $now_month, $now_day, $now_year);
					
					// ②[<<前]ボタンクリック時
					if(isset($selected_tenpo_disp_mode['-1'])){
						// 1か月前の日付を計算
						$calc_unix_date = strtotime('-1 month', $now_unix_date);
					}
					// ③[後>>]ボタンクリック時
					if(isset($selected_tenpo_disp_mode['1'])){
						// 1か月後の日付を計算
						$calc_unix_date = strtotime('+1 month', $now_unix_date);
					}
					// UNIX時を「Y-m-d」書式に変換し、セッション情報に戻す
					$_SESSION['Auth']['User']['disp_now_day'] = date('Y-m-d', $calc_unix_date);
					// セッション情報内の日付を分割し、「年」「月」「日」の各変数に代入
					list($year, $month, $day) = explode('-', $_SESSION['Auth']['User']['disp_now_day']);
    			}
    			
    			// 現在の「日」
				$today = date('d');
				// 現在の「日」セル用背景色
				$today_col_bg_color = '#FFFF99';
				// 月初日
				$first_day = mktime(0, 0, 0, $month, 1, $year);
				// その月の「最初の曜日」
				$first = date('w', $first_day);
				// その月の「日数」
				$total = date('t', $first_day);
				// その月の「週の数」
				$week = ceil($total/7);
				// ただし、その月の最初の曜日が「金曜日」もしくは「土曜日」の場合は、「週の数」に1プラスする。
				// （※この処理を忘れると、月末日のセルが生成されません）
				if (($total % 7 > 7 - $first) || ($total % 7 == 0 && $first != 0)) {
					$week++;
				}
				
				// その月の「1日～月末日」を格納した配列
				for($i=1; $i<=$total; $i++){
					$_SESSION['Auth']['User']['disp_cell'][$i] = $i;
				}
						
				echo $year.'年'.$month.'月'.'です。';
						
				for($i=1; $i<=$week*7; $i++){
										
					// 「日曜日」から行を出力する
					if($i % 7 == 1){
						echo '<tr>';
					}
					
					// 「月初日」より前のセルもしくは、「月末日」より後のセルは、空セルを出力させる
					if (($i -1 < $first) || ($i > $total + $first)) {
        				echo '<td>&nbsp;</td>';
    				}else{
    					// 「日曜日」の日付の文字色を赤に設定
        				if($i % 7 == 1){
            				$col = '#FF0000';
            			// 「土曜日」の日付の文字色を青に設定
        				}else if($i % 7 == 0){
        					$col = '#000FFF';
        				// 平日の日付の文字色を黒に設定
        				}else{
        					$col = '#000000';
        				}
        				
        				// 本日の日付セルには、背景色ありで出力
        				if($i-1 == $today && $year == date('Y') && $month == date('m')){
        					echo '<td style="background:' . $today_col_bg_color . '"><font color=' . $col . '>' . ($i - $first) . '</font></td>';
        				}else{
        					echo '<td><font color=' . $col . '>' . ($i - $first) . '</font></td>';
        				}
        			}
        			
        			// 「土曜日」の日付セルまで出力後、改行
        			if($i % 7 == 0) {
        				echo '</tr>';
        				
        				// 当月の予約情報から、「予約日」と「お客様名」を配列形式で取得
        				$yoyaku_day = array();
        				$yoyaku_name = array();
        				if(isset($yoyaku_jyoho_list)){
        					for($j=0; $j<count($yoyaku_jyoho_list); $j++){
        						$yoyaku_day[] = explode('-', $yoyaku_jyoho_list[$j]['YoyakuJyoho']['yoyaku_day']);
        						$yoyaku_name[] = $yoyaku_jyoho_list[$j]['YoyakuJyoho']['user_name'];
        					}
        				}
        						
        				// 「予約情報」を表示するセル行（1日あたり4行）を出力
        				for($j=1; $j<=4; $j++){
        					echo '<tr>';
        					for($k=1; $k<=7; $k++){
        						echo '<td>&nbsp;</td>';
        						//echo '<td id="[' .$k.']['.$j.']" style="' .dispCellBackground($_SESSION['Auth']['User']['disp_cell'][19], $yoyaku_day). 'border:none">' .dispYoyakuName($_SESSION['Auth']['User']['disp_cell'][19], $yoyaku_day, $yoyaku_name, $first). '</td>';
        					}
        					echo '</tr>';
        				}
        			}
        		}
    		}?>
    </table>
    </div>

	<?php //echo debug($_SESSION, $showHTML = true, $showFrom = true); ?>
	<?php //echo debug($yoyaku_day, $showHTML = true, $showFrom = true); ?>
	<?php //echo debug($yoyaku_name, $showHTML = true, $showFrom = true); ?>
    
	

<script type="text/javascript">
$(document).ready(function() {
    $('#fc1').fullCalendar({})
});
</script>

	
    </div>
	<table cellpadding="0" cellspacing="0">

	</table>
	<p>
</div>

<div class="actions">
	<h4><?php echo __('ホーム'); ?></h4>
    <hr />
	<ul>
		<li><?php echo $this->Html->link(__('トップ'), array('action' => 'index')); ?></li>
	</ul>
	
	
<!-- 使用しない
	<h4><?php echo __('勘定業務'); ?></h4>
    <hr />
	<ul>
		<li><?php echo $this->Html->link(__('経費管理'), array('controller' => 'Suppliers', 'action' => 'index')); ?> </li>
	</ul>
	<ul>
		<li><?php echo $this->Html->link(__('売上管理'), array('controller' => 'Profits', 'action' => 'index')); ?> </li>
	</ul>
	<ul>
		<li><?php echo $this->Html->link(__('スタッフ管理'), array('controller' => 'Staffs', 'action' => 'index')); ?> </li>
	</ul>
	<h4><?php echo __('損益計算表'); ?></h4>
    <hr />
	<ul>
		<li><?php echo $this->Html->link(__('集計'), array('controller' => 'Spreads', 'action' => 'index')); ?> </li>
	</ul>
-->
	
	
	
    <?php if ($_SESSION['role'] == 'admin') { ?>
        <h4><?php echo __('マスター管理'); ?></h4>
        <hr />
         <ul>
            <li><?php echo $this->Html->link(__('店舗情報'), array('controller' => 'TenpoJyohos', 'action' => 'index')); ?> </li>
        </ul>
        <ul>
            <li><?php echo $this->Html->link(__('予約コード管理'), array('controller' => 'YoyakucdMs', 'action' => 'index')); ?> </li>
        </ul>
        <ul>
            <li><?php echo $this->Html->link(__('座席管理'), array('controller' => 'ZasekiMs', 'action' => 'index')); ?> </li>
        </ul>
        <ul>
            <li><?php echo $this->Html->link(__('ゲストコード管理'), array('controller' => 'GesutocdMs', 'action' => 'index')); ?> </li>
        </ul>
        <ul>
            <li><?php echo $this->Html->link(__('店舗管理'), array('controller' => 'TenpoMs', 'action' => 'index')); ?> </li>
        </ul>
        
        
<!-- 使用しない
        <ul>
            <li><?php echo $this->Html->link(__('項目管理'), array('controller' => 'MainItems', 'action' => 'index')); ?> </li>
        </ul>
        <ul>
            <li><?php echo $this->Html->link(__('品目管理'), array('controller' => 'Items', 'action' => 'index')); ?> </li>
        </ul>
        <ul>
            <li><?php echo $this->Html->link(__('予算管理'), array('controller' => 'Funds', 'action' => 'index')); ?> </li>
        </ul>
-->


        <h4><?php echo __('ユーザー管理'); ?></h4>
        <hr />
        <ul>
            <li><?php echo $this->Html->link(__('ユーザー管理'), array('controller' => 'users', 'action' => 'index')); ?></li>
        </ul>
        <br />
    <?php } ?>
     
    <!-- ここから作成していく -->
    <h4><?php echo __('予約登録'); ?></h4>
    <hr />
    <?php echo $this->Form->create('YoyakuJyoho'); ?>
    <ul>
    	<li>
    		<?php echo $this->Form->input('tenpo_name', array('label'=>'店舗', 'type'=>'select', 'options'=> $tenpos, 'div'=>false)); ?>
    	</li>
    	<li>
    		<?php echo $this->Form->input('user_name', array('label' => 'お客様名', 'after' => '様')); ?>
    	</li>
    	<li>
    		<?php echo $this->Form->input('renrakusaki', array('label' => '連絡先')); ?>
    	</li>
    	<li>
    		<?php echo $this->Form->input('ninzu', array('label' => '人数', 'after' => '名様')); ?>
    	</li>
    	<li>
    		<?php echo $this->Form->label('来店日'); ?>
			<?php echo $this->DatePicker->datepicker('yoyaku_day', array('type' => 'text', 'label' => false, 'readonly' => true)); ?>
    	</li>
    	<li>
    		<?php echo $this->Form->label('来店時間'); ?>
    		<?php echo $this->Form->hour('raiten_time', '24', array('empty' => false)); ?>時
    		<?php echo $this->Form->minute('raiten_time', array('empty' => false, 'interval' => 30)); ?>分
    	</li>
    	<li>
    		<?php echo $this->Form->label('退店時間'); ?>
    		<?php echo $this->Form->hour('taiten_time', '24', array('empty' => false)); ?>時
    		<?php echo $this->Form->minute('taiten_time', array('empty' => false, 'interval' => 30)); ?>分
    	</li>
    	<li>
    		<?php echo $this->Form->input('yoyaku_note', array('type' => 'textarea', 'label' => '予約ノート')); ?>
    	</li>
    </ul>
    <h4><?php echo __('予約コード'); ?></h4>
    <hr />
	<?php echo $this->Form->input('yoyaku_code', array('label'=>false, 'type'=>'select', 'multiple'=>'checkbox', 'options'=>$yoyakucds, 'div'=>false)); ?>
	<br />
	
	<h4><?php echo __('座席'); ?></h4>
    <hr />
	<?php echo $this->Form->input('zaseki', array('label'=>false, 'type'=>'select', 'multiple'=>'checkbox', 'options'=>$zasekis, 'div'=>false)); ?>
	<br />
	
    <?php echo $this->Form->input('gesuto_note', array('type' => 'textarea', 'label' => 'ゲストノート')); ?>
	
	<h4><?php echo __('ゲストコード'); ?></h4>
    <hr />
    <?php echo $this->Form->input('gesuto_code', array('label'=>false, 'type'=>'select', 'multiple'=>'checkbox', 'options'=>$gesutos, 'div'=>false)); ?>
	
	<br />
	
	<?php echo $this->Form->postButton('予約情報登録', array('controller' => 'YoyakuJyohos', 'action' => 'index')); ?>	

	


</div>
