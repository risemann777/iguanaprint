<div class="container" id="blog">
  <div class="row">
    <aside class="span3 sidebar" id="widgetarea-sidebar">
      <?$this->renderPartial('/common/_sidebar_search');?>
      <?$this->renderPartial('/common/_sidebar_slider');?>
      <?$this->renderPartial('/common/_popular');?>
    </aside>
    <div class="span9">
      <p>Результаты поиска по запросу: <strong><i><?=$match;?></i></strong></p>
      <div class="search-results">
        Ничего не найдено
      </div>
    </div>
  </div>
</div>