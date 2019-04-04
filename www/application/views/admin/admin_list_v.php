<?php 
	require_once("application/common/item_constants.php");

	$type = array_flip($type);
	$material = array_flip($material);
	$pattern = array_flip($pattern);
	$color = array_flip($color);
	$color_tone = array_flip($color_tone);
	$line = array_flip($line);
	$neck_line = array_flip($neck_line);
	$arm_length = array_flip($arm_length);
	$btn = array_flip($btn);
	$length = array_flip($length);
	$pocket = array_flip($pocket);
	$wrinkle_shape = array_flip($wrinkle_shape);
	$sleeve_shape = array_flip($sleeve_shape);

?>

<script>
 $(document).ready(function(){
      $("#search_btn").click(function(){
        if($("#q").val() == ''){
          alert('검색어를 입력하세요');
          return false;
        }else{
          var act = '/admin/lists/<?php echo $this->uri->segment(3);?>/q/'+$("#q").val()+'/page/1/k/contents';
          $("#bd_search").attr('action',act).submit();
        }
      });
    });
</script>

<div class="container" style="margin:0px;">
	<div class="container">

		<?php
				$attributes =array('id' => 'bd_search', 'method' => 'post', 'style' => 'display:inline;');
				echo form_open('', $attributes);
				?>	
			<input type="text" name="search_word" id="q" onkeypress="board_search_enter(document.q);" />
			<input class="btn btn-success"type="button" value="search" id="search_btn" />
		</form>
			<a href="/admin/write/<?php echo $this->uri->segment(3);?>/page/<?php if($this->uri->segment(5) == ''){echo 1;}else{echo $this->uri->segment(5);}?>" class="btn btn-primary">write</a>
	</div>
	<article id = "board_area" style="margin-top:100px;align:center;margin-left:20px;">
		<table class="table table-bordered" cellspaCodeIgniterng = "0" cellpadding = "0">
			<thead>
				<th scope="col">image</th>
				<?php
					for($i=0;$i< $table_head['col_num'] ;$i++){
						echo '<th scope="col">'.$table_head[$i].'</th>';
					}
				?>
				<th scope="col"></th>
			</thead>
			<tbody>
				<?php
					foreach($list as $lt){
				?>
					<tr>
						
						<th scope="col"><img src="<?php echo $lt['item_path'].$lt['item_name']?>" height="200px" width="200px"/></th>
						<th scope="row">
							<?php echo $lt['tid'];?>
						</th>
						<?php
						$output=0;
							for($i=1;$i<$table_head['col_num']; $i++){
								if($table_head[$i] == "type"){
									$output = $type[$lt[$table_head[$i]]];
								}elseif($table_head[$i] == "material"){
									$output = $material[$lt[$table_head[$i]]];
								}elseif($table_head[$i] == "pattern"){
									$output = $pattern[$lt[$table_head[$i]]];
								}elseif($table_head[$i] == "color"){
									$output = $color[$lt[$table_head[$i]]];
								}elseif($table_head[$i] == "color_tone"){
									$output = $color_tone[$lt[$table_head[$i]]];
								}elseif($table_head[$i] == "line"){
									$output = $line[$lt[$table_head[$i]]];
								}elseif($table_head[$i] == "neck_line"){
									$output = $neck_line[$lt[$table_head[$i]]];
								}elseif($table_head[$i] == "arm_length"){
									$output = $arm_length[$lt[$table_head[$i]]];
								}elseif($table_head[$i] == "btn"){
									$output = $btn[$lt[$table_head[$i]]];
								}elseif($table_head[$i] == "length"){
									$output = $length[$lt[$table_head[$i]]];
								}elseif($table_head[$i] == "pocket"){
									$output = $pocket[$lt[$table_head[$i]]];
								}elseif($table_head[$i] == "wrinkle_shape"){
									$output = $wrinkle_shape[$lt[$table_head[$i]]];
								}elseif($table_head[$i] == "sleeve_shape"){
									$output = $sleeve_shape[$lt[$table_head[$i]]];
								}
								// echo '<td>'.$lt[''.$table_head[$i]].'</td>';
								echo '<td>'.$output.'</td>';
							}
						?>
						<td><a href="/admin/delete/table_favor/<?php echo $lt['tid']?>/<?php echo $this->uri->segment(5)?>">delete</a></td>
					</tr>
				<?php
					}
				?>
			</tr>
			</tbody>
	        <tfoot>
	        	<tr>
	                <th colspan="7"><?php echo $pagination;?></th>
	        </tfoot>
		</table>
</article>
</div>
