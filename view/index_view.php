<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  
  <title>商品一覧</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'index.css'); ?>">
</head>
<body>
  <?php include VIEW_PATH . $header; ?>
  

  <div class="container">
    <h2>Favorite Items...</h2>
    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <!-- 商品並べ替え -->
    <form id="submit_form" action="index.php" method="GET" class="justify-content-end form-inline">
      <div class="form-group">
          <select id="submit_select" class="form-control" name ="sort">
            <option value="created_desc" <?php if($sort === 'created_desc') { print 'selected'; } ?>>新着順</option>
            <option value="price_asc" <?php if($sort === 'price_asc') { print 'selected'; } ?>>価格の安い順</option>
            <option value="price_desc" <?php if($sort === 'price_desc') { print 'selected'; } ?>>価格の高い順</option>
          </select>
      </div>
    </form>

    <div class="card-deck">
      <?php foreach($items as $item){ ?>
        <div class="col-4 item">
          <div class="card h-100 text-center">
            <figure class="card-body">
              <img class="card-img" src="<?php print h(IMAGE_PATH . $item['image']); ?>">
              <figcaption>
                <h5 class="font-weight-bold"><?php print h($item['name']); ?></h5>
                <?php print h(number_format($item['price'])); ?> JPY
                  <?php if($item['stock'] > 0){ ?>
                  <div class="tocart_btn">
                    <form action="index_add_cart.php" method="post">
                      <!-- トークン埋め込み -->
                      <input type="hidden" name="token" value="<?=$token?>">
                      <input type="submit" value="to CART" class="btn btn-light btn-block">
                      <input type="hidden" name="item_id" value="<?php print($item['item_id']); ?>">
                    </form>
                  </div>
                  <div class="iteminfo_btn">
                    <!-- 商品詳細ページリンク -->
                    <form action="index_item_detail.php" method="post">
                      <!-- トークン埋め込み -->
                      <input type="hidden" name="token" value="<?=$token?>">
                      <input type="submit" value="Item Information" class="btn btn-light btn-block">
                      <input type="hidden" name="item_id" value="<?php print($item['item_id']); ?>">
                    </form>
                  </div>
                <?php } else { ?>
                  <p class="text-danger">SOULD OUT.</p>
                <?php } ?>
              </figcaption>
            </figure>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
  <!-- footer -->
  <?php include VIEW_PATH . 'templates/footer.php'; ?>
  <!-- javascriptファイル読み込み -->
  <script type="text/javascript" src="assets/js/index.js"></script>
</body>
</html>