jQuery(document).ready(function ($) {

    var checkbox_list = '';
    $.each(halimrp_cfg, function (i, item) {

        var issues_name = item.replace('(', '<br><span class="text-sm">').replace(')', '</span>')
        checkbox_list += `<li class="list-group-item">
                            <input type="checkbox" name="issues[]" class="report-checkbox" id="item_`+ i + `" value="` + item + `">
                            <label class="custom-control-label" for="item_`+ i + `">` + issues_name + `</label>
                        </li>`;
    });

    var clickedButton;
    var currentForm;
    $('.halim-submit').prop("disabled", false);
    $('.halim-switch').click(function () {
        jQuery('body').append(`<div class="modal fade" id="ajax-reportModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title text-success"><i class="hl-attention"></i> `+ halim_report.report_lng.report_heading_title + `</h4>
                    </div>
                    <div class="modal-body" style="overflow:hidden;">
                        <div class="halim-content col-xs-12 report-modal">
                            <div class="halim-message"></div>
                            <ul class="list-group list-group-flush issues-list">
                                `+ checkbox_list + `
                            </ul>
                            <div class="halim-form" style="display:none;">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item" style="overflow:hidden; border:none">
                                        <input type="text" required class="form-control input-name" id="input-name" placeholder="`+ halim_report.report_lng.name_or_email + `">
                                    </li>
                                    <li class="list-group-item" style="overflow:hidden;border:none">
                                        <textarea rows="5" class="form-control input-content col-md-12" id="input-content" placeholder="`+ halim_report.report_lng.msg + `" required ></textarea>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer modal-footer-report" style="display:none;">
                        <button type="button" class="btn btn-default btn-block btn-close hidden" data-dismiss="modal">`+ halim_report.report_lng.close + `</button>
                        <button type="button" class="btn btn-primary btn-block halim-submit"><img class="loading-img" style="display:none;" src="`+ halim_report.report_lng.loading_img + `"> ` + halim_report.report_lng.report_btn + `</button>
                    </div>
                </div>
            </div>
        </div>
        <style>
            span.text-sm {
                font-weight: normal;
            }
            .report-modal ul {
                list-style: none;
                padding-left: 15px;
            }
            .report-modal ul li {
                border-bottom: 1px solid #efefef;
                padding: 5px 0;
            }
            .report-modal ul li:last-child {
                border:none
            }
            .report-modal ul li input {
                float: left;
                margin-right: 10px;
            }
            .report-modal ul li label {
                font-weight: 600;
                font-size: 16px;
                color: #5e89b5;
                cursor: pointer;
                margin: 0;
            }
            .report-modal ul li label:hover{
                color: #333;
            }
            .report-modal ul li label span {
                font-weight: normal;
                font-size: 12px;
                color: #8e8e8e;
            }
        </style>`);

        jQuery('#ajax-reportModal').modal('show');
    });

    $(document).on('change', '.report-checkbox', function () {
        if ($(".report-checkbox:checked").length) {
            $('.halim-form, .modal-footer-report').show()
        } else {
            $('.halim-form, .modal-footer-report').hide()
        }
    })


    $('body').on('click', '.halim-submit', function () {
        clickedButton = $(this);
        currentForm = $('#ajax-reportModal');

        var issues = [];
        $('input[name="issues[]"]:checked').each(function (i) {
            issues[i] = $(this).val();
        });
        issues = issues.join('@');
        var _content = currentForm.find('.input-content').val();
        var _name = currentForm.find('.input-name').val();
        if (_name == '') {
            _name = 'Anonymous';
        }
        if (!issues) {
            currentForm.find('.halim-message').html('<div class="alert alert-danger" role="alert">' + halim_report.report_lng.alert + '</div>');
            return false;
        }

        clickedButton.prop("disabled", true);
        currentForm.find('.loading-img').show();
        $.ajax({
            type: 'POST',
            url: '/report',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                action: 'report',
                id_post: halim_cfg.post_id,
                server: halim_cfg.server,
                episode: halim_cfg.episode,
                post_name: $('h1.entry-title').text() + ' (server ' + halim_cfg.server + ')',
                halim_error_url: encodeURI(window.location),
                content: _content + '|' + issues,
                name: _name,
                issues: issues
            },
            success: function (data) {
                currentForm.find('.halim-message').html('<div class="alert alert-success" role="alert">' + halim_report.report_lng.msg_success + '</div>');
                currentForm.find('.halim-form, .loading-img, .issues-list').hide();
                currentForm.find('.btn-close').removeClass('hidden');
                currentForm.find('.halim-submit').hide();
            },
            error: function (e) {
                alert('Error!', e.message);
            }
        });
    });
});