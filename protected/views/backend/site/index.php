<? $this->rightFrameTitle = 'Главная страница'; ?>

<div class="row row-content">
    <div class="row form-horizontal">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <form method="post">
                    <input type="hidden" name="id" value="2">
                    <div class="panel-body">
                        <h3></span>Настройка SEO: Главная страница</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-4 col-xs-5 control-label">Title</label>
                            <div class="col-md-8 col-xs-7">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="main_seo[meta_title]" value="<?=$seo->meta_title?>" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 col-xs-5 control-label">Keywords</label>
                            <div class="col-md-8 col-xs-7">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="main_seo[meta_keywords]" value="<?=$seo->meta_keywords?>" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 col-xs-5 control-label">Description</label>
                            <div class="col-md-8 col-xs-7">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" name="main_seo[meta_description]" value="<?=$seo->meta_description?>" class="form-control"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-primary pull-right">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
