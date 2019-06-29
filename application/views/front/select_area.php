<div class="app-content content" style="max-width: 37.5rem;margin-left: auto;margin-right: auto;background-color: #f5f5f5;height: 100%;">
    <div class="content-wrapper" style="padding: 0;">
        <div class="content-header row m-0" style="height: 45px;position: fixed;top: 0;z-index: 2;color: #101010;
                                font-size: 18px; width: 100%;max-width: 37.5rem; background-color: #f8f8f8;">
            <div style="display: table;width: 100%;height: 100%;">
                <div style="display: table-cell;vertical-align: middle;text-align: center;">
                    <span onclick="go_index()" class="mdi mdi-chevron-left mdi-24px" style="float: left;margin-left: 10px;"></span>
                    <div style="margin-top: 5px;">
                        <span style="margin-left: -34px;">选择区域</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body hide_scrollbar" style="width: 100%;margin-top: 45px;position: absolute;bottom: 0;top: 0;overflow-y: scroll;">

            <div class="row ml-0 mr-0" style="width: 100%;height: 70px;background: white;padding-top: 15px;">

                <div style="width: 25%;height: 30px;line-height: 30px;text-align: center;">
                    <span class="text15_regular black444">省</span>
                </div>
                <div style="width: 75%;height: 40px;text-align: center;">
                    <select name="province" id="province" class="form-control" style="width: 90%;height: 30px;vertical-align: middle;margin-left: auto;margin-right: auto;">
                        <?php
                        $reversed = array_reverse($provinces);
                        foreach ($reversed as $province) {
                            if ($province['code']) {
                                $selected = '';
                                if ((int)$province['id'] === 10) {
                                    $selected = ' selected';
                                }
                                if ($province['count'] < 1) {
                                    echo '<option value="' . $province['id'] . '"' . $selected . '>' . $province['name'] . '</option>';
                                } else {
                                    echo '<option value="' . $province['id'] . '"' . $selected . '>' . $province['name'] . '&nbsp;&nbsp;&nbsp;&nbsp;(总区域: ' . $province['count'] . ')</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div id="selected_areas" style="width: 100%">
                <?php if (count($selected_areas) > 0){ foreach ($selected_areas as $area){ ?>
                    <div class="row mt-0 ml-0 mr-0 p-0" style="background-color: white;border-bottom:8px solid #f5f5f5;" onclick="go_select_land(<?php echo $area['id'] ?>)">
                        <p class="m-0 text14_regular black444" style="width: 100%;padding: 10px 10px 5px 10px;"><?php echo $area['name'] ?></p>
                        <p class="m-0 text14_regular blackAAA" style="padding: 5px 10px;"><?php echo $area['description'] ?></p>
                        <div class="row mt-0 ml-0 mr-0" style="padding: 10px;">
                            <img src="<?php echo base_url($area['picture']) ?>" style="width: 100%;height: 100%;">
                        </div>
                    </div>
                    <?php }
                }else{?>
                    <div style="width: 100%;text-align: center;"><h3>没有区域</h3></div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

        } );

        //===== load cities by selected province =====//
        $("#province").change(function() {
            var $province = $("#province").val();
            $.post("<?php echo base_url('front/selected_areas') ?>", {province: $province},
                function (data) {
                    var result = JSON.parse(data);
                    if (result.status == "success") {
                        var selected_areas = result['selected_areas'];
                        var html = '';
                        if (selected_areas.length > 0){
                            for (var i=0; i<selected_areas.length; i++){
                                var area = selected_areas[i];
                                html += '<div class="row mt-0 ml-0 mr-0 p-0" style="background-color: white;border-bottom:8px solid #f5f5f5;" onclick="go_select_land('+ area['id']+')">';
                                html += '<p class="m-0 text14_regular black444" style="width: 100%;padding: 10px 10px 5px 10px;">'+ area['name']+'</p>';
                                html += '<p class="m-0 text14_regular blackAAA" style="padding: 5px 10px;">'+ area['description']+ '</p>';
                                html += '<div class="row mt-0 ml-0 mr-0" style="padding: 10px;">';
                                html += '<img src="../../'+ area['picture']+ '" style="width: 100%;height: 100%;">';
                                html += '</div>';
                                html += '</div>';
                            }
                        }
                        else{
                            html += '<div style="width: 100%;text-align: center;"><h3>没有区域</h3></div>';
                        }
                        $('#selected_areas').html(html);

                    } else {
                        swal({
                            title: "错误",
                            text: "出了点问题。 请稍后再试。",
                            type: "error",
                            confirmButtonText: "确认"
                        }).then(function(e) {
                            location.reload();
                        });
                    }

                }
            );
        });


        function go_select_land(id) {
            location.href = "<?php echo base_url('front/select/land/')?>"+ id;
        }
        function go_index() {
            location.href = "<?php echo base_url('front/index')?>";
        }
    </script>