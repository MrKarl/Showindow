			<?php
				$i=0;
				foreach($list as $lt){
					if($i > $start_point){
			?>

					<div class="card" id="card<?php echo $i; ?>">
						<div class="image" id="<?php echo $i; ?>"><a href="#" data-toggle="modal" onclick="mk_modal('<?php echo $lt["tid"];?>','<?php echo $lt["item_path"].$lt["item_name"];?>','<?php echo $lt["gender"];?>','<?php echo $lt["card_id"];?>')"><img src="<?php echo $lt['item_path'].$lt['item_name'];?>"/></a></div>
						<div class="imagename"></a></div>
						<div class="star"></div>
						<div class="card_texts">
							<font style="font-family:sanserif; font-size:12px; color :#b5b5b5">
				<?php
										
								if(strlen($lt['contents']) > 55){
									echo substr($lt['contents'],0,53)."......";
								}else{
									echo $lt['contents']."<br/>";
								}
				?>				
							</font>
						</div>
				<?php
						$attributes = array('role' => 'form', 'id' => 'upload_action', 'class' => 'closet_share');
						echo form_open_multipart('/mycloset/scrab_form',$attributes);
				?>
							<input type="hidden" name="item_img" value="<?php echo $lt['item_path'].$lt['item_name'];?>"/>
							<input type="hidden" name="item_tid" value="<?php echo $lt['tid'];?>"/>
							<input type="hidden" name="gender" value="<?php echo $lt['gender'];?>"/>
							<!-- <button type="submit" style="border:0; background-color:#fff;"><img src="/assets/images/glyphicons_019_heart_empty.png"/></button> -->
						</form>
					</div>

				<?php
					}

					$i++;
					if($i > $start_point + 9){
						break;
					}
					
				}
			?>