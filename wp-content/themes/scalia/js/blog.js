(function($) {
    $(function() {
        $('.blog-style-masonry').each(function() {
            var $blog = $(this);
            $blog.imagesLoaded( function() {
                $blog.prev('.preloader').remove();
                $blog.isotope({
                    itemSelector: 'article',
                    layoutMode: 'masonry',
                    masonry: {
                        columnWidth: 'article:not(.sticky)'
                    }
                });
                
                if (!$('body').hasClass('lazy-disabled')) {
                    var elems = $blog.isotope('getItemElements');
                    var items = [];
                    for (var i = 0; i < elems.length; i++)
                        items.push($blog.isotope('getItem', elems[i]));
                    $blog.isotope('reveal', items);
                }

            });
					$(document).on('show.vc.tab', '[data-vc-tabs]', function() {
						var $tab = $(this).data('vc.tabs').getTarget();
						if($tab.find($blog).length) {
							$blog.isotope('layout');
						}
					});
        });

        $('.blog:not(body)').each(function() {
            var $blog = $(this);

            $('.blog-load-more', $blog.parent()).on('click', function() {
                blog_load_core_request($blog);
            });
        });
    });

    function blog_load_core_request($blog) {
        var data = blog_ajax;
        
        var is_processing_request = $blog.data('request-process') || false;
        if (is_processing_request)
            return false;
        $blog.data('request-process', true);

        data['action'] = 'blog_load_more';
        data['data']['paged'] = $blog.data('next-page') || 2;

        $('.blog-load-more .sc-button', $blog.parent()).before('<div class="loading"></div>');

        $.ajax({
            type: 'post',
            dataType: 'json',
            url: blog_ajax.url,
            data: data,
            success: function(response) {
                if (response.status == 'success') {
                    var $newItems = $(response.html);
                    var current_page = $newItems.data('page');
                    var next_page = $newItems.data('next-page');

                    if ($blog.hasClass('blog-style-masonry')) {
                        var $inserted_data = $($newItems.html());
                        $inserted_data.imagesLoaded(function() {
                            $blog.isotope('insert', $inserted_data);
                            $('.blog-load-more .loading', $blog.parent()).remove();

                            $blog.data('next-page', next_page);
                            if (next_page > 0) {
                                $('.blog-load-more', $blog.parent()).show();
                            } else {
                                $('.blog-load-more', $blog.parent()).hide();
                            }
                        });
                    }
                    else {
                        $blog.append($newItems.html());
                        $('.blog-load-more .loading', $blog.parent()).remove();
                        $blog.data('next-page', next_page);
                        if (next_page > 0) {
                            $('.blog-load-more', $blog.parent()).show();
                        } else {
                            $('.blog-load-more', $blog.parent()).hide();
                        }
                    }
                    $blog.data('request-process', false);
                } else {
                    alert(response.message);
                }
            }
        });
    }

})(jQuery);
