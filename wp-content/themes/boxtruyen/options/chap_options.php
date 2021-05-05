<?php if(get_query_var('post_type') == 'chap'):?>
<div class="dropdown">
    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span></a>
     <div class="dropdown-menu dropdown-menu-right settings">
        <form class="form-horizontal">
            <div class="form-group form-group-sm">
                <label class="col-sm-2 col-md-5 control-label" for="truyen-background">Màu nền</label>
                <div class="col-sm-5 col-md-7">
                    <select class="form-control" id="truyen-background">
                        <option value="#FBFBFB">Xám nhạt</option>
                        <option value="hatsan">Hạt sạn</option>
                        <option value="#FFF">Trắng</option>
                        <option value="#DEB887">Nền gỗ</option>
                        <option value="#F5DEB3">Nền gỗ nhạt</option>
                        <option value="#FAEBB7">Vàng nhạt</option>
                        <option value="#DBCA9B">Vàng ố</option>
                        <option value="#FCF0E1">Hồng nhạt</option>
                        <option value="#151515">Tối</option>
                    </select>
                </div>
            </div>
            <div class="form-group form-group-sm">
                <label class="col-sm-2 col-md-5 control-label" for="font-chu">Phông chữ</label>
                <div class="col-sm-5 col-md-7">
                    <select class="form-control" id="font-chu">
                        <option value="Palatino Linotype, sans-serif">Palatino Linotype</option>
                        <option value="Segoe UI, sans-serif">Segoe UI</option>
                        <option value="Roboto, sans-serif">Roboto</option>
                        <option value="Roboto Condensed, sans-serif">Roboto Condensed</option>
                        <option value="Patrick Hand, sans-serif">Patrick Hand</option>
                        <option value="Noticia Text, sans-serif">Noticia Text</option>
                        <option value="Times New Roman, sans-serif">Times New Roman</option>
                        <option value="Verdana, sans-serif">Verdana</option>
                        <option value="Tahoma, sans-serif">Tahoma</option>
                        <option value="Arial, sans-serif">Arial</option>
                    </select>
                </div>
            </div>
            <div class="form-group form-group-sm">
                <label class="col-sm-2 col-md-5 control-label" for="mau-chu">Màu chữ</label>
                <div class="col-sm-5 col-md-7">
                    <select class="form-control" id="mau-chu">
                        <option value="#DDDDDD">Sáng</option>
                        <option value="#3B3B3B">Tối</option>
                    </select>
                </div>
            </div>
            <div class="form-group form-group-sm">
                <label class="col-sm-2 col-md-5 control-label" for="size-chu">Size chữ</label>
                <div class="col-sm-5 col-md-7">
                    <select class="form-control" id="size-chu">
                        <option value="16px">16</option>
                        <option value="18px">18</option>
                        <option value="20px">20</option>
                        <option value="22px">22</option>
                        <option value="24px">24</option>
                        <option value="26px">26</option>
                        <option value="28px">28</option>
                        <option value="30px">30</option>
                    </select>
                </div>
            </div>
            <div class="form-group form-group-sm">
                <label class="col-sm-2 col-md-5 control-label" for="line-height">Chiều cao dòng</label>
                <div class="col-sm-5 col-md-7">
                    <select class="form-control" id="line-height">
                        <option value="100%">100%</option>
                        <option value="120%">120%</option>
                        <option value="140%">140%</option>
                        <option value="160%">160%</option>
                        <option value="180%">180%</option>
                        <option value="200%">200%</option>
                    </select>
                </div>
            </div>
            <div class="form-group form-group-sm">
                <label class="col-sm-2 col-md-5 control-label">Toàn trang</label>
                <div class="col-sm-5 col-md-7">
                    <label class="radio-inline" for="fluid-yes">
                        <input type="radio" name="fluid-switch" id="fluid-yes" value="yes"> Có
                    </label>
                    <label class="radio-inline" for="fluid-no">
                        <input type="radio" name="fluid-switch" id="fluid-no" value="no" checked> Không
                    </label>
                </div>
            </div>
            <div class="form-group form-group-sm">
                <label class="col-sm-2 col-md-5 control-label">Không cách đoạn</label>
                <div class="col-sm-5 col-md-7">
                    <label class="radio-inline" for="onebreak-yes">
                        <input type="radio" name="onebreak-switch" id="onebreak-yes" value="yes"> Có
                    </label>
                    <label class="radio-inline" for="onebreak-no">
                        <input type="radio" name="onebreak-switch" id="onebreak-no" value="no" checked> Không
                    </label>
                </div>
            </div>
        </form>
    </div>
</div>
<?php endif;?>