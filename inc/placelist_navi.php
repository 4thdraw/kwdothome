


<!-- 공용 서브 네비 -->
<div id="<?php echo $subnavilist['wrapper_id']; ?>" class="py-lg-5 mt-3 py-4 mt-md-4 w-100 px-4 px-lg-0">
    <div class="max-width mx-auto d-flex flex-wrap justify-content-between fs-20 fw500 text-nowrap">
    <?php foreach ($subnavilist['items'] as $menuKey => $item): ?>
    <?php 
        $isActive = (isset($_GET['skey1']) && $_GET['skey1'] === $menuKey) ? 'border-active' : '';
        $isActiveText = (isset($_GET['skey1']) && $_GET['skey1'] === $menuKey) ? 'active-color' : '';
        $firstSubmenuKey = array_key_first($item['submenus']);
    ?>
        <a href="<?php echo $subnavilist['base_url']; ?>?skey1=<?php echo $menuKey; ?>&skey2=<?php echo $firstSubmenuKey; ?>"
        class="d-flex flex-column align-items-center gap-3 qurationitem col-lg col-3 quration-items<?php echo (array_search($item, $subnavilist['items']) + 1); ?> px-2 px-lg-2 px-xl-0 <?php echo ((array_search($item, $subnavilist['items']) >= 4) ? 'mt-4 mt-lg-0' : ''); ?>">
            
            <?php if (!empty($item['img'])): ?>
                <img src="<?php echo $subnavilist['img_url'] . $item['img']; ?>" class="img-fluid <?php echo $isActive; ?> border rounded-circle border-width-2" alt="<?php echo htmlspecialchars($item['menunm']); ?>">
            <?php endif; ?>
            
            <span class="<?php echo $isActiveText; ?>"><?php echo htmlspecialchars($item['menunm']); ?></span>
        </a>
    <?php endforeach; ?>

    </div>
</div>
