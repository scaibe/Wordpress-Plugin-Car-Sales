<?php 

function init_metabox_gallery_carsales($post_id){

		add_meta_box(
			'gallery-metabox',
			'Galleria Auto in Vendita',
			'gallery_metabox_carsales_callback',
			'auto',
			'normal',
			'core'
		);

    add_meta_box(
			'feature-metabox',
			'Caratteristiche Auto in Vendita',
			'feature_metabox_carsales_callback',
			'auto',
			'normal',
			'high'
		);
	
}

function gallery_metabox_carsales_callback() {

	  global $post;

    wp_nonce_field( basename(__FILE__), 'gallery_meta_nonce' );
    $ids = get_post_meta($post->ID, 'DREAM_auto_slider', true);

    ?>
    <table class="form-table">
      <tr>
        <td>
          <a class="gallery-add button" href="#" data-uploader-title="Aggiungi immagine/i alla gallery" data-uploader-button-text="Aggiungi immagine/i">Aggiungi immagine/i</a>

          <ul id="gallery-metabox-list">
            <?php if ($ids) : foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value); ?>
            
            <li>
              <input type="hidden" name="DREAM_auto_slider[<?php echo $key; ?>]" value="<?php echo $value; ?>">
              <img class="image" src="<?php echo $image[0]; ?>">
              <a class="change-image button button-small" href="#" data-uploader-title="Cambia immagine" data-uploader-button-text="Cambia immagine">Cambia immagine</a><br>
              <small><a class="remove-image" href="#">Rimuovi immagine</a></small>
            </li>

            <?php endforeach; endif; ?>
          </ul>
        </td>
      </tr>
    </table>
	<?php
}

function feature_metabox_carsales_callback() {

  global $post;

  wp_nonce_field( basename(__FILE__), 'feature_meta_nonce' );

  $price = get_post_meta($post->ID,'DREAM_auto_price', true);
  $engine = get_post_meta($post->ID,'DREAM_auto_engine', true);
  $km_done = get_post_meta($post->ID,'DREAM_auto_km_done', true);
  $seat = get_post_meta($post->ID,'DREAM_auto_seat_capacity', true);

  ?>
  <div class="wrapper-feature">
    <p>Prezzo di Vendita:</p>
    <p><strong>€</strong> <input type="text" name="DREAM_auto_price" id="DREAM_auto_price" value="<?php echo $price; ?>"></p>
  </div>
  <div class="wrapper-feature">
    <p>Motore:</p>
    <p><strong>cm<sup>3</sup></strong> <input type="text" name="DREAM_auto_engine" id="DREAM_auto_engine" value="<?php echo $engine; ?>"></p>
  </div>
  <div class="wrapper-feature">
    <p>Chilometri totali:</p>
    <p><strong>Km</strong> <input type="text" name="DREAM_auto_km_done" id="DREAM_auto_km_done" value="<?php echo $km_done; ?>"></p>
  </div>
  <div class="wrapper-feature">
    <p>Posti:</p>
    <p><strong>n&deg;</strong> <input type="text" name="DREAM_auto_seat_capacity" id="DREAM_auto_seat_capacity" value="<?php echo $seat; ?>"></p>
  </div>

  <?php

}

function gallery_meta_save($post_id) {
	if (!isset($_POST['gallery_meta_nonce']) || !wp_verify_nonce($_POST['gallery_meta_nonce'], basename(__FILE__))) return;

	if (!current_user_can('edit_post', $post_id)) return;

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

	if(isset($_POST['DREAM_auto_slider'])) {
		update_post_meta($post_id, 'DREAM_auto_slider', $_POST['DREAM_auto_slider']);
	} else {
		delete_post_meta($post_id, 'DREAM_auto_slider');
	}
}

function feature_meta_save($post_id) {
	if (!isset($_POST['feature_meta_nonce']) || !wp_verify_nonce($_POST['feature_meta_nonce'], basename(__FILE__))) return;

	if (!current_user_can('edit_post', $post_id)) return;

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

	if(isset($_POST['DREAM_auto_price'])) {
		update_post_meta($post_id, 'DREAM_auto_price', $_POST['DREAM_auto_price']);
	} else {
		delete_post_meta($post_id, 'DREAM_auto_price');
	}

  if(isset($_POST['DREAM_auto_engine'])) {
		update_post_meta($post_id, 'DREAM_auto_engine', $_POST['DREAM_auto_engine']);
	} else {
		delete_post_meta($post_id, 'DREAM_auto_engine');
	}

  if(isset($_POST['DREAM_auto_km_done'])) {
		update_post_meta($post_id, 'DREAM_auto_km_done', $_POST['DREAM_auto_km_done']);
	} else {
		delete_post_meta($post_id, 'DREAM_auto_km_done');
	}

  if(isset($_POST['DREAM_auto_seat_capacity'])) {
		update_post_meta($post_id, 'DREAM_auto_seat_capacity', $_POST['DREAM_auto_seat_capacity']);
	} else {
		delete_post_meta($post_id, 'DREAM_auto_seat_capacity');
	}
}

?>