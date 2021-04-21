require('./configurators');

import Vue from 'vue/dist/vue';

window.Vue = Vue;

Vue.component('gallery', require('./components/gallery.vue').default);


$(function () {


    $('#sidebar [data-toggle="tooltip"]').tooltip('disable');
    $('.sidebar-collapse').on('click', function () {
        $('#sidebar,#content').toggleClass('active');
        $('#sidebar [data-toggle="tooltip"]').tooltip('toggleEnabled')

    });

    $(".confirm-button").on("click", function () {
        $("#delete-item").attr("href", $(this).attr("data-value"));
    });

    $("#search-single").keypress(function (e) {
        if (e.which == 13) {
            Filter.search();
        }
    });

    $("#btn-search").on("click", function () {
        Filter.search();
    });

    $(".checkbox-modern").on("click", function () {
        if ($(this).is(":checked")) {
            $(this).val(1);
        } else {
            $(this).val(0);
        }
    });

    $(".button-select a").on("click", function (e) {
        e.preventDefault();
        var text = $(this).text();
        var val = $(this).attr("data-val");
        var btn = $(this).parents(".button-select");
        btn.find("button").text(text);
        btn.find("input").val(val);
    });

    $('#select_all').change(function () {
        var checkboxes = $(".page-category-wrap").find(':checkbox');
        checkboxes.prop('checked', $(this).is(':checked'));
    });
});

var Filter = {
    search: function () {
        var url = $("#search-single").attr("data-url") + "?q=" + encodeURIComponent($("#search-single").val());
        $(location).attr('href', url);
    }
}

$(document).ready(function () {
    let button = $('.add-attributes-button');
    let wrapper = $('.attributes-wrapper');

    $(button).on('click', function (e) {
        e.preventDefault();

        $(wrapper).append(' <div class="form-inline">\n' +
            '                    <div class="col-md-5 form-group">\n' +
            '                        <label class="control-label col-sm-12" for="module"> Attribute </label>\n' +
            '                        <input id="attribute" type="text" name="attributes[]" class="form-control" value="">\n' +
            '                    </div>\n' +
            '                    <div class="col-md-5 form-group">\n' +
            '                        <label class="control-label col-sm-12" for="module"> Value </label>\n' +
            '                        <input id="attribute" type="text" name="values[]" class="form-control" value="">\n' +
            '                    </div>\n' +
            '                    <div class="col-md-2">\n' +
            '                        <div class="delete-attribute btn btn-danger">\n' +
            '                            <i class="fas fa-trash"></i>\n' +
            '                        </div>\n' +
            '                    </div>\n' +
            '                </div>');
    });

    $(wrapper).on("click", ".delete-attribute", function (e) {
        e.preventDefault();
        $(this).parent('div').parent('div').remove();
    })
})

$(document).ready(function () {
    let button = $('.add-story');
    let wrapper = $('.tab-pane__story-wrap');

    $(button).on('click', function (e) {
        e.preventDefault();

        $(wrapper).append('   <div class="tab-pane__story">\n' +
            '                    <div class="tab-pane__story-info">\n' +
            '                        <div class="form-group">\n' +
            '                            <label class="control-label" for="url_name">Url Name</label>\n' +
            '                            <div class="col-sm-5">\n' +
            '                                <input id="url_name" type="text" name="url_name[]"\n' +
            '                                       class="form-control"\n' +
            '                                       value="">\n' +
            '                            </div>\n' +
            '                        </div>\n' +
            '                        <div class="form-group">\n' +
            '                            <label class="control-label" for="url_address">Url Address</label>\n' +
            '                            <div class="col-sm-5">\n' +
            '                                <input id="url_address" type="text" name="url_address[]"\n' +
            '                                       class="form-control"\n' +
            '                                       value="">\n' +
            '                            </div>\n' +
            '                        </div>\n' +
            '                    </div>\n' +
            '                    <a class="btn btn-danger btn-delete-story"><i class="fas fa-trash-alt"></i></a>\n' +
            '                </div>');
    });

    $(wrapper).on("click", ".btn-delete-story", function (e) {
        e.preventDefault();
        $(this).parent('div').remove();
    })
});

$(document).ready(function () {

    $(".upload-button").click(function (event) {

        event.preventDefault();

        var form = $('#imgUploadForm')[0];
        var route = $('#imgUploadForm').attr('action');
        var data = new FormData(form);

        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: route,
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (data) {
                if (typeof data['errors'] == 'undefined') {
                    $('#imgUploadForm input').val("")
                    $('#uploadImg').val(null)
                    $(".uploadImg").text("Choose image:")
                    window.location.reload();
                } else {

                }
            },
            error: function (e) {
                // document.getElementById("checkTerms").style.borderColor = "#d24a43";
            }
        });

    });
})

// $(document).ready(function () {
//     let counter = 1;
//     $('.add-story').on('click', function () {
//         var clone = $(".tab-pane__story:not(.cloned)").clone();
//         clone.addClass('cloned');
//         clone.find('.img-input').attr("id", "story-input" + counter);
//         clone.find('label').attr("for", "story-input" + counter);
//         clone.find('label').attr("id", "story-input" + counter);
//         clone.find('input').val();
//         counter++;
//         clone.prependTo(".story-cloned__wrap");
//     })
//     $('.tab-pane__story').on("click", ".btn-delete-story", function (e) {
//         e.preventDefault();
//         alert('clicked')
//         $(this).parent('div').remove();
//     })
//     $('.add-story-edit').on('click', function () {
//         $('.story-cloned__wrap').append('   <div class="tab-pane__story-add">\n' +
//             '                    <div class="form-group required">\n' +
//             '                        <label class="control-label col-sm-4">Image</label>\n' +
//             '                        <div style="max-width: 250px;">\n' +
//             '                            <div class="img-input-wrap" style="margin-left: 15px">\n' +
//             '                                <input class="img-input" id="story-input" name="story_img[]" type=\'file\' accept=".png, .jpg, .jpeg, .gif, .svg"/>\n' +
//             '                                <label class="img-story-upload" id="story-input-id" for="story-input">Choose img:</label>\n' +
//             '                            </div>\n' +
//             '                        </div>\n' +
//             '                    </div>\n' +
//             '                    <div class="tab-pane__story-info">\n' +
//             '                        <div class="form-group">\n' +
//             '                            <label class="control-label" for="url_name">Url Name</label>\n' +
//             '                            <div class="col-sm-5">\n' +
//             '                                <input id="url_name" type="text" name="url_name[]"\n' +
//             '                                       class="form-control"\n' +
//             '                                       value="">\n' +
//             '                            </div>\n' +
//             '                        </div>\n' +
//             '                        <div class="form-group">\n' +
//             '                            <label class="control-label" for="url_address">Url Address</label>\n' +
//             '                            <div class="col-sm-5">\n' +
//             '                                <input id="url_address{" type="text" name="url_address[]"\n' +
//             '                                       class="form-control"\n' +
//             '                                       value="">\n' +
//             '                            </div>\n' +
//             '                        </div>\n' +
//             '                    </div>\n' +
//             '                </div>')
//     })
// })

$(document).ready(function () {
    $("input[type='file']").change(function () {
        var filename = this.files[0].name;
        let id = $(this).siblings('label').attr('id');
        $('#' + id).text(filename);
    });
})



