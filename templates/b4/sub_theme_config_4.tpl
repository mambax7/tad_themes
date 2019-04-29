<!--logo圖-->
<div class="row">
    <div class="col-sm-6">
        <!-- 上傳logo圖-->
        <{if $enable.logo_img=="1"}>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-sm-right">
                    <{$smarty.const._MA_TAD_THEMES_UPLOAD}><{$smarty.const._MA_TADTHEMES_LOGO_IMG}>
                </label>
                <div class="col-sm-9">
                    <{$upform_logo}>
                </div>
            </div>
        <{else}>
            <input type="hidden" name="logo_img" id="logo_img" value="<{$logo_img}>">
        <{/if}>

        <!-- logo圖位置-->
        <{if $enable.logo_position=="1"}>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-sm-right">
                    <{$smarty.const._MA_TADTHEMES_LOGO_POSITION}>
                </label>
                <div class="col-sm-9">
                    <label class="radio">
                        <input type="radio" name="logo_position" onClick="logo_place_setup(this.value)" class="logo_position" value="page" <{if $logo_position=="page"}>checked<{/if}>><{$smarty.const._MA_TADTHEMES_LOGO_PAGE}>
                    </label>
                    <label class="radio">
                        <input type="radio" name="logo_position" onClick="logo_place_setup(this.value)" value="slide" <{if $logo_position=="slide"}>checked<{/if}>><{$smarty.const._MA_TADTHEMES_LOGO_SLIDE}>
                    </label>
                </div>
            </div>
        <{else}>
            <input type="hidden" name="logo_position" id="logo_position" value="<{$logo_position}>">
        <{/if}>



        <!-- 選擇預設logo圖-->
        <{if $enable.logo_top=="1" or  $enable.logo_right=="1" or $enable.logo_left=="1" or $enable.logo_bottom=="1"}>
            <div class="form-group row" id="logo_place_setup">
                <label class="col-sm-3 col-form-label text-sm-right">
                    <{$smarty.const._MA_TADTHEMES_LOGO_PLACE}>
                </label>
                <div class="col-sm-9">
                    <{if $enable.logo_top=="1"}>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input type="text" name="logo_top" class="form-control <{$validate.logo_top}> " value="<{$logo_top}>" id="logo_top" onChange="if(this.value > 0){$('#logo_bottom').val(0);}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">px</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                    <{else}>
                        <input type="hidden" name="logo_top" id="logo_top" value="<{$logo_top}>">
                    <{/if}>


                <div class="row">
                        <{if $enable.logo_left=="1"}>
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <input type="text" name="logo_left" class="form-control <{$validate.logo_left}>" value="<{$logo_left}>" id="logo_left" onChange="if(this.value > 0){$('#logo_right').val(0);$('#logo_center').attr('checked',false);}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">px</span>
                                    </div>
                                </div>
                            </div>
                        <{else}>
                            <input type="hidden" name="logo_left" id="logo_left" value="<{$logo_left}>">
                        <{/if}>

                        <div class="col-sm-2 text-center">
                            <{if $enable.logo_center=="1"}>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="logo_center" value="1" id="logo_center" <{if $logo_center=='1'}>checked<{/if}> onChange="if($('#logo_center').attr('checked')){$('#logo_left').val(0);$('#logo_right').val(0);}"><{$smarty.const._MA_TADTHEMES_LOGO_CENTER}>
                                </label>
                            <{else}>
                                <input type="hidden" name="logo_center" id="logo_right" value="<{$logo_right}>">
                            <{/if}>
                        </div>

                        <{if $enable.logo_right=="1"}>
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <input type="text" name="logo_right" class="form-control <{$validate.logo_right}>" value="<{$logo_right}>" id="logo_right" onChange="if(this.value > 0){$('#logo_left').val(0);$('#logo_center').attr('checked',false);}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">px</span>
                                    </div>
                                </div>
                            </div>
                        <{else}>
                            <input type="hidden" name="logo_right" id="logo_right" value="<{$logo_right}>">
                        <{/if}>
                    </div>

                    <{if $enable.logo_bottom=="1"}>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input type="text" name="logo_bottom" class="form-control <{$validate.logo_bottom}>" value="<{$logo_bottom}>" id="logo_bottom" onChange="if(this.value > 0){$('#logo_top').val(0);}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">px</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                    <{else}>
                        <input type="hidden" name="logo_bottom" id="logo_bottom" value="<{$logo_bottom}>">
                    <{/if}>
                </div>
            </div>
        <{/if}>
    </div>

    <{if $enable.logo_img=="1"}>
        <div class="col-sm-6">
            <!-- 選擇預設logo圖-->
            <div style="width:60px; height:86px; display:inline-block; margin:4px;">
                <label for="logo_img0" style="width:60px; height:60px;border:1px dotted gray;" >
                    <input type="radio" name="logo_img" id="logo_img0" value="" <{if $logo_img==""}>checked<{/if}>>
                    <{$smarty.const._MA_TADTHEMES_NONE}><{$smarty.const._MA_TADTHEMES_LOGO_IMG}>
                </label>
            </div>

            <{if $all_logo}>
                <{foreach from=$all_logo item=logo}>
                <div style="width:60px; height:86px; display:inline-block; margin:4px;">
                    <label for="logo_img<{$logo.files_sn}>" style="width:60px; height:60px; background:#000000 url(<{$logo.tb_path}>);background-repeat:no-repeat;background-position:left center;border:1px solid gray;" >
                        <input type="radio" name="logo_img" id="logo_img<{$logo.files_sn}>" value="<{$logo.path}>" <{if $logo_img==$logo.path}>checked<{/if}>>
                    </label>

                    <label class="del_img_box" style="font-size:11px;"  id="del_img<{$logo.files_sn}>">
                        <input type="checkbox" value="<{$logo.files_sn}>" name="del_file[<{$logo.files_sn}>]"> <{$smarty.const._TAD_DEL}>
                    </label>
                </div>
                <{/foreach}>
            <{/if}>

        </div>
    <{/if}>
</div>


<{if $config2_logo}>
    <hr>
    <h4>
        <{$smarty.const._MA_TADTHEMES_LOGO_IMG}><{$smarty.const._MA_TADTHEMES_CONFIG2}>
        <a href="main.php?op=export_config2&theme_id=<{$theme_id}>&type=config2_logo" class="btn btn-info pull-right"><{$smarty.const._MA_TADTHEMES_EXPORT2|sprintf:'config2_logo'}></a>
    </h4>
    <input type="hidden" name="config2[]" value="config2_logo">
    <hr>
    <{foreach from=$config2_logo item=config}>
        <{includeq file="$xoops_rootpath/modules/tad_themes/templates/sub_theme_config_other.tpl"}>
    <{/foreach}>
<{/if}>