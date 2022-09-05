@extends('layouts.quiz')

@section('content')
    <div id="main" class="quiz">
        <input type="text" id="exam_id" value="{{ $exam->id }}" hidden>
        <input type="text" id="screen_height" value="{{ $exam->screen_height }}" hidden>
        <input type="text" id="screen_width" value="{{ $exam->screen_width }}" hidden>
        {{--        <h2>{{ $exam->name }}</h2>--}}


        <nav data-role="ribbonmenu">
            <ul class="tabs-holder">
                <li id="section_home_form"><a href="#section_Home_FormView">Home</a></li>
                <li id="section_home_slide" style="display: none;"><a href="#section_Home_SlideView">Home</a></li>
                <li id="section_insert" style="display: none;"><a href="#section_Insert">Insert</a></li>
                <li id="section_design" style="display: none;"><a href="#section_Design">Design</a></li>
            </ul>
            <div class="content-holder" style="height: 104px;">
                <div class="section" id="section_Design">
                    <div class="group">
                        <div class="ribbon-split-button">
                            <button class="ribbon-main" id="theme_select_btn_top">
                            <span class="icon">
                                <img loading="lazy" src="{{ url("/images/ribbon_imgs/design-1.png") }}">
                            </span>
                            </button>
                            <span class="ribbon-split dropdown-toggle" id="theme_select_btn_bottom">Themes</span>
                            <div id="design_themes_panel_holder" class="ribbon-dropdaown" data-role="dropdown"
                                 data-duration="100">
                                <div>
                                    <div class="design_themes_panels_divider">No theme</div>
                                    <div class="design_themes_panels"
                                         style="font-family: Calibri; color: #000000; background-image: unset; background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels_divider">Office</div>
                                    <div class="design_themes_panels" title="White Lines"
                                         style="font-family: Calibri; color: #4d4d4d; background-image: url( {{url('/images/theme_backgrounds/white_lines.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Black Drops"
                                         style="font-family: Calibri; color: #ffffff; background-image: url( {{url('/images/theme_backgrounds/black_drops.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Green Texture"
                                         style="font-family: Calibri; color: #000000; background-image: url( {{url('/images/theme_backgrounds/green_texture.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Abstract Beige"
                                         style="font-family: Calibri; color: #000000; background-image: url( {{url('/images/theme_backgrounds/abstract_beige.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Color Line"
                                         style="font-family: Calibri; color: #ffffff; background-image: url( {{url('/images/theme_backgrounds/color_line.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Misty Forest"
                                         style="font-family: Calibri; color: #000000; background-image: url( {{url('/images/theme_backgrounds/misty_forest.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Grid"
                                         style="font-family: Calibri; color: #ffffff; background-image: url( {{url('/images/theme_backgrounds/grid.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Dark Gray Gradient"
                                         style="font-family: Calibri; color: #ffffff; background-image: url( {{url('/images/theme_backgrounds/dark_gray_gradient.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Cloud"
                                         style="font-family: Calibri; color: #000000; background-image: url( {{url('/images/theme_backgrounds/cloud.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Abstract Colors"
                                         style="font-family: Calibri; color: #000000; background-image: url( {{url('/images/theme_backgrounds/abstract_colors.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Geometry"
                                         style="font-family: Calibri; color: #000000; background-image: url( {{url('/images/theme_backgrounds/geometry.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Blue Drops"
                                         style="font-family: Calibri; color: #000000; background-image: url( {{url('/images/theme_backgrounds/blue_drops.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels_divider">Built In</div>
                                    <div class="design_themes_panels" title="Default"
                                         style="font-family: Calibri; color: #4d4d4d; background-image: url( {{url('/images/theme_backgrounds/default.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Blue Gradient"
                                         style="font-family: Calibri; color: #ffffff; background-image: url( {{url('/images/theme_backgrounds/blue_gradient.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Blue Line"
                                         style="font-family: Calibri; color: #000000; background-image: url( {{url('/images/theme_backgrounds/blue_line.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Dark Blue Shine"
                                         style="font-family: Calibri; color: #ffffff; background-image: url( {{url('/images/theme_backgrounds/dark_blue_shine.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Dark Blue Abstract"
                                         style="font-family: Calibri; color: #ffffff; background-image: url( {{url('/images/theme_backgrounds/dark_blue_abstract.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Dark Brown Abstract"
                                         style="font-family: Calibri; color: #ffffff; background-image: url( {{url('/images/theme_backgrounds/dark_brown_abstract.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Dark Green Shine"
                                         style="font-family: Calibri; color: #000000; background-image: url( {{url('/images/theme_backgrounds/dark_green_shine.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Corner Light Blue Abstract"
                                         style="font-family: Calibri; color: #36608b; background-image: url( {{url('/images/theme_backgrounds/corner_light_blue_abstract.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Light Blue Blur"
                                         style="font-family: Calibri; color: #14395c; background-image: url( {{url('/images/theme_backgrounds/light_blue_blur.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Light Brown Shine"
                                         style="font-family: Calibri; color: #423226; background-image: url( {{url('/images/theme_backgrounds/light_brown_shine.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Light Brown Abstract"
                                         style="font-family: Calibri; color: #523c2c; background-image: url( {{url('/images/theme_backgrounds/light_brown_abstract.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Light Green"
                                         style="font-family: Calibri; color: #2a2a2a; background-image: url( {{url('/images/theme_backgrounds/light_green.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Dark Greenish Blue Shine"
                                         style="font-family: Calibri; color: #ffffff; background-image: url( {{url('/images/theme_backgrounds/dark_greenish_blue_shine.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Dark Purple Gradient"
                                         style="font-family: Calibri; color: #ffffff; background-image: url( {{url('/images/theme_backgrounds/dark_purple_gradient.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Dark Red"
                                         style="font-family: Calibri; color: #ffffff; background-image: url( {{url('/images/theme_backgrounds/dark_red.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Green Line"
                                         style="font-family: Calibri; color: #000000; background-image: url( {{url('/images/theme_backgrounds/green_line.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Light Brown Texture"
                                         style="font-family: Calibri; color: #000000; background-image: url( {{url('/images/theme_backgrounds/light_brown_texture.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Light Metal Texture"
                                         style="font-family: Calibri; color: #000000; background-image: url( {{url('/images/theme_backgrounds/light_metal_texture.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Purple Line"
                                         style="font-family: Calibri; color: #000000; background-image: url( {{url('/images/theme_backgrounds/purple_line.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Turguoise Gradient"
                                         style="font-family: Calibri; color: #ffffff; background-image: url( {{url('/images/theme_backgrounds/turguoise_gradient.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Turguoise Sea Texture"
                                         style="font-family: Calibri; color: #ffffff; background-image: url( {{url('/images/theme_backgrounds/turguoise_sea_texture.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Dark Red Waves"
                                         style="font-family: Calibri; color: #ffffff; background-image: url( {{url('/images/theme_backgrounds/dark_red_waves.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Blue Green Gradient"
                                         style="font-family: Calibri; color: #ffffff; background-image: url( {{url('/images/theme_backgrounds/blue_green_gradient.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Dark Red Gradient"
                                         style="font-family: Calibri; color: #ffffff; background-image: url( {{url('/images/theme_backgrounds/dark_red_gradient.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Gray Gradient"
                                         style="font-family: Calibri; color: #414141; background-image: url( {{url('/images/theme_backgrounds/gray_gradient.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Light Blue Gradient"
                                         style="font-family: Calibri; color: #2a2a2a; background-image: url( {{url('/images/theme_backgrounds/light_blue_gradient.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Light Brown Gradient"
                                         style="font-family: Calibri; color: #59493c; background-image: url( {{url('/images/theme_backgrounds/light_brown_gradient.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Lavender Gradient"
                                         style="font-family: Calibri; color: #414141; background-image: url( {{url('/images/theme_backgrounds/lavender_gradient.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Light Purple"
                                         style="font-family: Calibri; color: #414141; background-image: url( {{url('/images/theme_backgrounds/light_purple.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Light Rose Gradient"
                                         style="font-family: Calibri; color: #2a2a2a; background-image: url( {{url('/images/theme_backgrounds/light_rose_gradient.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Purple Yellow Gradient on Texture"
                                         style="font-family: Calibri; color: #573b3e; background-image: url( {{url('/images/theme_backgrounds/purple_yellow_gradient_on_texture.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Red Brown Gradient"
                                         style="font-family: Calibri; color: #ffffff; background-image: url( {{url('/images/theme_backgrounds/red_brown_gradient.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Red Green Gradient"
                                         style="font-family: Calibri; color: #310e0a; background-image: url( {{url('/images/theme_backgrounds/red_green_gradient.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Rose Green Gradient"
                                         style="font-family: Calibri; color: #414141; background-image: url( {{url('/images/theme_backgrounds/rose_green_gradient.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Turguoise Blue Gradient"
                                         style="font-family: Calibri; color: #ffffff; background-image: url( {{url('/images/theme_backgrounds/turguoise_blue_gradient.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Wood Texture"
                                         style="font-family: Calibri; color: #4e2b10; background-image: url( {{url('/images/theme_backgrounds/wood_texture.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Yellow Green Gradient"
                                         style="font-family: Calibri; color: #132300; background-image: url( {{url('/images/theme_backgrounds/yellow_green_gradient.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Dark Blue"
                                         style="font-family: Calibri; color: #ffffff; background-image: url( {{url('/images/theme_backgrounds/dark_blue.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Dark Green"
                                         style="font-family: Calibri; color: #ffffff; background-image: url( {{url('/images/theme_backgrounds/dark_green.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                    <div class="design_themes_panels" title="Light Brown"
                                         style="font-family: Calibri; color: #523f32; background-image: url( {{url('/images/theme_backgrounds/light_brown.png')}} ); background-size: 100% 100%; ">
                                        <span>Aa</span></div>
                                </div>
                            </div>
                        </div>
                        <span class="title">Themes</span>
                        <div class="group-divider"></div>
                    </div>
                    <div class="group">
                        <div data-role="button-group" data-cls-active="active">
                            <button class="ribbon-button" id="format_bg_btn">
                            <span class="icon">
                                <img loading="lazy" src="{{ url("/images/ribbon_imgs/design-2.png") }}">
                            </span>
                                <span class="caption" style="line-height: 11px;">Format <br> Background</span>
                            </button>
                        </div>
                        <span class="title">Settings</span>
                        <div class="group-divider"></div>
                    </div>
                    <div class="group">
                        <div class="ribbon-split-button">
                            <button class="ribbon-main" id="design_section_preview_btn_top">
                            <span class="icon">
                                <img loading="lazy" src="{{ url("/images/ribbon_imgs/design-3.png") }}">
                            </span>
                            </button>
                            <span class="ribbon-split dropdown-toggle">Preview</span>
                            <ul class="ribbon-dropdown" data-role="dropdown" data-duration="100">
                                <li class="design_preview_submenu preview_slide_btn"
                                    id="design_section_preview_btn_bottom"
                                    style="background-image: url({{ url("/images/ribbon_imgs/design-pre-1.png") }});">
                                    Preview
                                    Slide
                                </li>
                                <li class="design_preview_submenu preview_group_btn">Preview Group</li>
                                <li class="design_preview_submenu preview_quiz_btn">Preview Quiz</li>
                            </ul>
                        </div>
                        <span class="title">Publish</span>
                        <div class="group-divider"></div>
                    </div>
                    <div class="group">
                    </div>
                </div>
                <div class="section" id="section_Insert">
                    <div class="group">
                        <div class="ribbon-split-button">
                            <button class="ribbon-main" id="insert_section_question_btn_top">
                            <span class="icon">
                                <img loading="lazy" src="{{ url("/images/ribbon_imgs/insert-1.png") }}">
                            </span>
                            </button>
                            <span class="ribbon-split dropdown-toggle"
                                  id="insert_section_question_btn_bottom">Question</span>
                            <ul class="ribbon-dropdown" data-role="dropdown" data-duration="100">
                                <div id="quiz_types_panel">
                                    <div>
                                        <img class="quiz_types" src="{{ url("/images/ribbon_imgs/slices/1_01.png") }}"
                                             onclick="create_quiz(1, '{{ url('/') }}', '{{ csrf_token() }}')">
                                        <img class="tooltip_pic" src="{{ url("/images/ribbon_imgs/tip_01.png") }}">
                                    </div>
                                    <div>
                                        <img class="quiz_types" src="{{ url("/images/ribbon_imgs/slices/1_02.png") }}"
                                             onclick="create_quiz(2, '{{ url('/') }}', '{{ csrf_token() }}')">
                                        <img class="tooltip_pic" src="{{ url("/images/ribbon_imgs/tip_02.png") }}">
                                    </div>
                                    <div>
                                        <img class="quiz_types" src="{{ url("/images/ribbon_imgs/slices/1_03.png") }}"
                                             onclick="create_quiz(3, '{{ url('/') }}', '{{ csrf_token() }}')">
                                        <img class="tooltip_pic" src="{{ url("/images/ribbon_imgs/tip_03.png") }}">
                                    </div>
                                    <div>
                                        <img class="quiz_types" src="{{ url("/images/ribbon_imgs/slices/1_04.png") }}"
                                             onclick="create_quiz(4, '{{ url('/') }}', '{{ csrf_token() }}')">
                                        <img class="tooltip_pic" src="{{ url("/images/ribbon_imgs/tip_04.png") }}">
                                    </div>
                                    <div>
                                        <img class="quiz_types" src="{{ url("/images/ribbon_imgs/slices/1_05.png") }}"
                                             onclick="create_quiz(5, '{{ url('/') }}', '{{ csrf_token() }}')">
                                        <img class="tooltip_pic" src="{{ url("/images/ribbon_imgs/tip_05.png") }}">
                                    </div>
                                    <div>
                                        <img class="quiz_types" src="{{ url("/images/ribbon_imgs/slices/1_06.png") }}"
                                             onclick="create_quiz(6, '{{ url('/') }}', '{{ csrf_token() }}')">
                                        <img class="tooltip_pic" src="{{ url("/images/ribbon_imgs/tip_06.png") }}">
                                    </div>
                                    <div>
                                        <img class="quiz_types" src="{{ url("/images/ribbon_imgs/slices/1_07.png") }}"
                                             onclick="create_quiz(7, '{{ url('/') }}', '{{ csrf_token() }}')">
                                        <img class="tooltip_pic" src="{{ url("/images/ribbon_imgs/tip_07.png") }}">
                                    </div>
                                    <div>
                                        <img class="quiz_types" src="{{ url("/images/ribbon_imgs/slices/1_08.png") }}"
                                             onclick="create_quiz(8, '{{ url('/') }}', '{{ csrf_token() }}')">
                                        <img class="tooltip_pic" src="{{ url("/images/ribbon_imgs/tip_08.png") }}">
                                    </div>
                                    <div>
                                        <img class="quiz_types" src="{{ url("/images/ribbon_imgs/slices/1_09.png") }}"
                                             onclick="create_quiz(9, '{{ url('/') }}', '{{ csrf_token() }}')">
                                        <img class="tooltip_pic" src="{{ url("/images/ribbon_imgs/tip_09.png") }}">
                                    </div>
                                    <div>
                                        <img class="quiz_types" src="{{ url("/images/ribbon_imgs/slices/1_10.png") }}"
                                             onclick="create_quiz(10, '{{ url('/') }}', '{{ csrf_token() }}')">
                                        <img class="tooltip_pic" src="{{ url("/images/ribbon_imgs/tip_10.png") }}">
                                    </div>
                                    <div>
                                        <img class="quiz_types" src="{{ url("/images/ribbon_imgs/slices/1_11.png") }}"
                                             onclick="create_quiz(11, '{{ url('/') }}', '{{ csrf_token() }}')">
                                        <img class="tooltip_pic" src="{{ url("/images/ribbon_imgs/tip_11.png") }}">
                                    </div>
                                </div>
                            </ul>
                        </div>
                        <button class="ribbon-button info_slide_btn"
                                onclick="create_quiz(12, '{{ url('/') }}', '{{ csrf_token() }}')">
                        <span class="icon">
                            <img loading="lazy" src="{{ url("/images/ribbon_imgs/insert-2.png") }}">
                        </span>
                            <span class="caption">Info Slide</span>
                        </button>
                        <span class="title">Slides</span>
                        <div class="group-divider"></div>
                    </div>
                    <div class="group" id="import_picture_group">
                        <button class="ribbon-button" id="slide_view_picture_import_btn">
                        <span class="icon">
                            <img loading="lazy" src="{{ url("/images/ribbon_imgs/insert-3.png") }}">
                        </span>
                            <span class="caption">Picture</span>
                        </button>
                        <input id="slide_view_picture_file_selector" type="file" accept="image/*" data-role="file"
                               style="display: none;">
                        <span class="title">Images</span>
                        <div class="group-divider"></div>
                    </div>
                    <div class="group">
                        <button class="ribbon-button" id="insert_textbox_btn">
                        <span class="icon">
                            <img loading="lazy" src="{{ url("/images/ribbon_imgs/insert-5.png") }}">
                        </span>
                            <span class="caption">TextBox</span>
                        </button>
                    <!-- <button class="ribbon-button" id="insert_textbox_btn">
                        <span class="icon">
                            <img loading="lazy" src="{{ url("/images/ribbon_imgs/insert-6.png") }}">
                        </span>
                        <span class="caption">Hyperlink</span>
                    </button> -->

                        <div style="display: flex; flex-direction: column; margin-top: 26px;">
                            <button class="ribbon-icon-button hyperlink_btn" id="slide_view_hyperlink_btn">
                            <span class="icon">
                                <img loading="lazy" src="{{ url("/images/ribbon_imgs/insert-6.png") }}">
                            </span>
                                <span class="caption">Hyperlink</span>
                            </button>
                        </div>
                        <span class="title">Text</span>
                        <div class="group-divider"></div>
                    </div>
                    <div class="group">
                        <button class="ribbon-button" id="slide_view_video_file_btn">
                        <span class="icon">
                            <img loading="lazy" src="{{ url("/images/ribbon_imgs/insert-9.png") }}">
                        </span>
                            <span class="caption">Video</span>
                        </button>
                        <input id="slide_view_video_file_selector" type="file" data-role="file"
                               accept=".mp4, .webm, .ogg"
                               style="display: none;">
                        <div class="ribbon-split-button">
                            <button class="ribbon-main" id="insert_section_audio_btn_top">
                            <span class="icon">
                                <img loading="lazy" src="{{ url("/images/ribbon_imgs/insert-10.png") }}">
                            </span>
                            </button>
                            <span class="ribbon-split dropdown-toggle">Audio</span>
                            <ul class="ribbon-dropdown" data-role="dropdown" data-duration="100"
                                style="width: 150px; text-align: left;">
                                <li class="insert_audio" id="slide_view_insert_audio_btn"
                                    style="background-image: url({{ url("/images/ribbon_imgs/insert/audio-1.png") }});">
                                    From
                                    File...
                                </li>
                                <input id="slide_view_audio_selector" type="file" data-role="file"
                                       style="display: none;" accept=".mp3, .wav, .ogg">
                                <li class="insert_audio" id="slide_view_rec_mic_btn"
                                    style="background-image: url({{ url("/images/ribbon_imgs/insert/audio-2.png") }});">
                                    Record Mic...
                                </li>
                            <!-- <li class="insert_audio" id="slide_view_mic_settings_btn"
                                style="background-image: url({{ url("/images/ribbon_imgs/insert/audio-3.png") }});">
                                Microphone Settings
                            </li> -->
                            </ul>
                        </div>
                        <span class="title">Media</span>
                        <div class="group-divider"></div>
                    </div>
                    <div class="group">
                        <div class="ribbon-split-button">
                            <button class="ribbon-main" id="insert_section_slide_btn_top">
                            <span class="icon">
                                <img loading="lazy" src="{{ url("/images/ribbon_imgs/insert-11.png") }}">
                            </span>
                            </button>
                            <span class="ribbon-split dropdown-toggle">Preview</span>
                            <ul class="ribbon-dropdown" data-role="dropdown" data-duration="100">
                                <li class="design_preview_submenu preview_slide_btn"
                                    id="insert_section_slide_btn_bottom"
                                    style="background-image: url({{ url("/images/ribbon_imgs/design-pre-1.png") }});">
                                    Preview
                                    Slide
                                </li>
                                <li class="design_preview_submenu preview_group_btn">Preview Group</li>
                                <li class="design_preview_submenu preview_quiz_btn">Preview Quiz</li>
                            </ul>
                        </div>
                        <span class="title">Publish</span>
                        <div class="group-divider"></div>
                    </div>
                    <div class="group">
                    </div>
                </div>
                <div class="section" id="section_Home_SlideView">
                    <div class="group" style="flex: 0 0 170px;">
                        <button id="slide_view_paste_btn" class="ribbon-button paste_btn">
                        <span class="icon">
                            <img loading="lazy" src="{{ url("/images/ribbon_imgs/home-1.png") }}">
                        </span>
                            <span class="caption">Paste</span>
                        </button>
                        <div style="display: flex; flex-direction: column;">
                            <button id="slide_view_cut_btn" class="ribbon-icon-button cut_btn">
                            <span class="icon">
                                <img loading="lazy" src="{{ url("/images/ribbon_imgs/home-2.png") }}">
                            </span>
                                <span class="caption">Cut</span>
                            </button>
                            <button id="slide_view_copy_btn" class="ribbon-icon-button copy_btn">
                            <span class="icon">
                                <img loading="lazy" src="{{ url("/images/ribbon_imgs/home-3.png") }}">
                            </span>
                                <span class="caption">Copy</span>
                            </button>
                        <!-- <button id="format_painter_btn" class="ribbon-icon-button" disabled>
                            <span class="icon">
                                <img loading="lazy" src="{{ url("/images/ribbon_imgs/home-4.png") }}">
                            </span>
                                <span class="caption">Format Painter</span>
                            </button> -->
                        </div>
                        <span class="title">Clipboard</span>
                        <div class="group-divider"></div>
                    </div>
                    <div class="group">
                        <div style="display: flex;flex-direction: column;">
                            <div class="ribbon-split-button" style="display: flex; flex-direction: column;">
                                <button class="ribbon-icon-button">
                                <span class="icon">
                                    <img loading="lazy" src="{{ url("/images/ribbon_imgs/home-5.png") }}"
                                         style="width: 100%; height: 100%;">
                                </span>
                                    <span class="caption dropdown-toggle"
                                          style="margin-top: 0; margin-left: 3px;">Layout</span>
                                </button>
                                <div class="ribbon-dropdown" data-role="dropdown" data-duration="100"
                                     style="position: absolute; width: 600px;">
                                    <div style="display: flex;flex-wrap: wrap;">
                                        <div class="layout_panel_divider">Default</div>
                                        <div id="layout_default" class="layout_panel_img_holder"
                                             data-questyle="8 4 92 30" data-anstyle="44 4 92 48" data-medstyle=""><img
                                                src="{{ url("/images/ribbon_imgs/images/layout_ver_01.png") }}"></div>
                                        <div class="layout_panel_divider">Side Panel</div>
                                        <div id="layout_side_panel_01" class="layout_panel_img_holder"
                                             data-questyle="8 44 52 30" data-anstyle="44 44 52 48"
                                             data-medstyle="8 4 37 84"><img
                                                src="{{ url("/images/ribbon_imgs/images/side_panel_01.png") }}"></div>
                                        <div id="layout_side_panel_02" class="layout_panel_img_holder"
                                             data-questyle="8 4 52 30" data-anstyle="44 4 52 48"
                                             data-medstyle="8 59 37 84"><img
                                                src="{{ url("/images/ribbon_imgs/images/side_panel_02.png") }}"></div>
                                        <div id="layout_side_panel_03" class="layout_panel_img_holder"
                                             data-questyle="8 4 52 30" data-anstyle="8 59 37 84"
                                             data-medstyle="44 4 52 48"><img
                                                src="{{ url("/images/ribbon_imgs/images/side_panel_03.png") }}"></div>
                                        <div class="layout_panel_divider">Horizontal</div>
                                        <div id="layout_horizontal_01" class="layout_panel_img_holder"
                                             data-questyle="8 4 92 26" data-anstyle="66 4 92 26"
                                             data-medstyle="37 4 92 26"><img
                                                src="{{ url("/images/ribbon_imgs/images/layout_hor_03.png") }}"></div>
                                        <div id="layout_horizontal_02" class="layout_panel_img_holder"
                                             data-questyle="37 4 92 26" data-anstyle="66 4 92 26"
                                             data-medstyle="8 4 92 26"><img
                                                src="{{ url("/images/ribbon_imgs/images/layout_hor_04.png") }}"></div>
                                        <div class="layout_panel_divider">Balanced Content</div>
                                        <div id="layout_balanced_01" class="layout_panel_img_holder"
                                             data-questyle="8 4 92 26" data-anstyle="38 4 45 54"
                                             data-medstyle="38 51 45 54"><img
                                                src="{{ url("/images/ribbon_imgs/images/balance_01.png") }}"></div>
                                        <div id="layout_balanced_02" class="layout_panel_img_holder"
                                             data-questyle="8 4 92 26" data-anstyle="38 51 45 54"
                                             data-medstyle="38 4 45 54"><img
                                                src="{{ url("/images/ribbon_imgs/images/balance_02.png") }}"></div>
                                        <div id="layout_balanced_03" class="layout_panel_img_holder"
                                             data-questyle="38 4 45 54" data-anstyle="38 51 45 54"
                                             data-medstyle="8 4 92 26"><img
                                                src="{{ url("/images/ribbon_imgs/images/balance_03.png") }}"></div>
                                    </div>
                                </div>
                            </div>
                            <button id="layout_reset_btn" class="ribbon-icon-button">
                            <span class="icon">
                                <img loading="lazy" src="{{ url("/images/ribbon_imgs/home-6.png") }}">
                            </span>
                                <span class="caption">Reset</span>
                            </button>
                            <div class="ribbon-split-button" style="display: flex; flex-direction: column;">

                                <button class="ribbon-icon-button">
                                <span class="icon">
                                    <img loading="lazy" src="{{ url("/images/ribbon_imgs/home-7.png") }}"
                                         style="width: 100%; height: 100%;">
                                </span>
                                    <span class="caption dropdown-toggle"
                                          style="margin-left: 5px; margin-top: 0;">Columns</span>
                                </button>
                                <ul id="layout_column_ul" class="ribbon-dropdown" data-role="dropdown"
                                    data-duration="100">
                                    <li style="background-image: url({{ url("/images/ribbon_imgs/column_1.png") }});"
                                        id="layout_column_01_btn"><a>1 Column</a></li>
                                    <li style="background-image: url({{ url("/images/ribbon_imgs/column_2.png") }});"
                                        id="layout_column_02_btn"><a>2 Column</a></li>
                                    <li style="background-image: url({{ url("/images/ribbon_imgs/column_3.png") }});"
                                        id="layout_column_03_btn"><a>3 Column</a></li>
                                    <li style="background-image: url({{ url("/images/ribbon_imgs/column_4.png") }});"
                                        id="layout_column_04_btn"><a>4 Column</a></li>
                                </ul>
                            </div>
                        </div>
                        <span class="title">Layout</span>
                        <div class="group-divider"></div>
                    </div>
                    <div class="group" style="flex: 0 0 280px; flex-wrap: wrap;">
                        <div style="display: flex; align-items: center;">
                            <select id="slide_view_font_family_selector"
                                    style="font-size: 12px; outline: none; width: 131px; height: 25px;">
                                <option style="font-family: 'Abadi MT Condensed Light';"
                                        value="Abadi MT Condensed Light">
                                    Abadi MT Condensed Light
                                </option>
                                <option style="font-family: 'Aharoni';" value="Aharoni">Aharoni</option>
                                <option style="font-family: 'Aharoni Bold';" value="Aharoni Bold">Aharoni Bold</option>
                                <option style="font-family: 'Aldhabi';" value="Aldhabi">Aldhabi</option>
                                <option style="font-family: 'AlternateGothic2 BT';" value="AlternateGothic2 BT">
                                    AlternateGothic2 BT
                                </option>
                                <option style="font-family: 'Andale Mono';" value="Andale Mono">Andale Mono</option>
                                <option style="font-family: 'Andalus';" value="Andalus">Andalus</option>
                                <option style="font-family: 'Angsana New';" value="Angsana New">Angsana New</option>
                                <option style="font-family: 'AngsanaUPC';" value="AngsanaUPC">AngsanaUPC</option>
                                <option style="font-family: 'Aparajita';" value="Aparajita">Aparajita</option>
                                <option style="font-family: 'Apple Chancery';" value="Apple Chancery">Apple Chancery
                                </option>
                                <option style="font-family: 'Arabic Typesetting';" value="Arabic Typesetting">Arabic
                                    Typesetting
                                </option>
                                <option style="font-family: 'Arial';" value="Arial" selected="selected">Arial</option>
                                <option style="font-family: 'Arial Black';" value="Arial Black">Arial Black</option>
                                <option style="font-family: 'Arial narrow';" value="Arial narrow">Arial narrow</option>
                                <option style="font-family: 'Arial Nova';" value="Arial Nova">Arial Nova</option>
                                <option style="font-family: 'Arial Rounded MT Bold';" value="Arial Rounded MT Bold">
                                    Arial
                                    Rounded MT Bold
                                </option>
                                <option style="font-family: 'Arnoldboecklin';" value="Arnoldboecklin">Arnoldboecklin
                                </option>
                                <option style="font-family: 'Avanta Garde';" value="Avanta Garde">Avanta Garde</option>
                                <option style="font-family: 'Bahnschrift';" value="Bahnschrift">Bahnschrift</option>
                                <option style="font-family: 'Bahnschrift Light';" value="Bahnschrift Light">Bahnschrift
                                    Light
                                </option>
                                <option style="font-family: 'Bahnschrift SemiBold';" value="Bahnschrift SemiBold">
                                    Bahnschrift SemiBold
                                </option>
                                <option style="font-family: 'Bahnschrift SemiLight';" value="Bahnschrift SemiLight">
                                    Bahnschrift SemiLight
                                </option>
                                <option style="font-family: 'Baskerville';" value="Baskerville">Baskerville</option>
                                <option style="font-family: 'Batang';" value="Batang">Batang</option>
                                <option style="font-family: 'BatangChe';" value="BatangChe">BatangChe</option>
                                <option style="font-family: 'Big Caslon';" value="Big Caslon">Big Caslon</option>
                                <option style="font-family: 'BIZ UDGothic';" value="BIZ UDGothic">BIZ UDGothic</option>
                                <option style="font-family: 'BIZ UDMincho Medium';" value="BIZ UDMincho Medium">BIZ
                                    UDMincho
                                    Medium
                                </option>
                                <option style="font-family: 'Blippo';" value="Blippo">Blippo</option>
                                <option style="font-family: 'Bodoni MT';" value="Bodoni MT">Bodoni MT</option>
                                <option style="font-family: 'Book Antiqua';" value="Book Antiqua">Book Antiqua</option>
                                <option style="font-family: 'Bookman';" value="Bookman">Bookman</option>
                                <option style="font-family: 'Bradley Hand';" value="Bradley Hand">Bradley Hand</option>
                                <option style="font-family: 'Browallia New';" value="Browallia New">Browallia New
                                </option>
                                <option style="font-family: 'BrowalliaUPC';" value="BrowalliaUPC">BrowalliaUPC</option>
                                <option style="font-family: 'Brush Script MT';" value="Brush Script MT">Brush Script MT
                                </option>
                                <option style="font-family: 'Brush Script Std';" value="Brush Script Std">Brush Script
                                    Std
                                </option>
                                <option style="font-family: 'Brushstroke';" value="Brushstroke">Brushstroke</option>
                                <option style="font-family: 'Calibri';" value="Calibri">Calibri</option>
                                <option style="font-family: 'Calibri Light';" value="Calibri Light">Calibri Light
                                </option>
                                <option style="font-family: 'Calisto MT';" value="Calisto MT">Calisto MT</option>
                                <option style="font-family: 'Cambodian';" value="Cambodian">Cambodian</option>
                                <option style="font-family: 'Cambria';" value="Cambria">Cambria</option>
                                <option style="font-family: 'Cambria Math';" value="Cambria Math">Cambria Math</option>
                                <option style="font-family: 'Candara';" value="Candara">Candara</option>
                                <option style="font-family: 'Century Gothic';" value="Century Gothic">Century Gothic
                                </option>
                                <option style="font-family: 'Chalkduster';" value="Chalkduster">Chalkduster</option>
                                <option style="font-family: 'Cherokee';" value="Cherokee">Cherokee</option>
                                <option style="font-family: 'Comic Sans';" value="Comic Sans">Comic Sans</option>
                                <option style="font-family: 'Comic Sans MS';" value="Comic Sans MS">Comic Sans MS
                                </option>
                                <option style="font-family: 'Consolas';" value="Consolas">Consolas</option>
                                <option style="font-family: 'Constantia';" value="Constantia">Constantia</option>
                                <option style="font-family: 'Copperplate';" value="Copperplate">Copperplate</option>
                                <option style="font-family: 'Copperplate Gothic Light';"
                                        value="Copperplate Gothic Light">
                                    Copperplate Gothic Light
                                </option>
                                <option style="font-family: 'Copperplate Gothic Bold';" value="Copperplate Gothic Bold">
                                    Copperplate Gothic Bold
                                </option>
                                <option style="font-family: 'Corbel';" value="Corbel">Corbel</option>
                                <option style="font-family: 'Cordia New';" value="Cordia New">Cordia New</option>
                                <option style="font-family: 'CordiaUPC';" value="CordiaUPC">CordiaUPC</option>
                                <option style="font-family: 'Courier';" value="Courier">Courier</option>
                                <option style="font-family: 'Courier New';" value="Courier New">Courier New</option>
                                <option style="font-family: 'DaunPenh';" value="DaunPenh">DaunPenh</option>
                                <option style="font-family: 'David';" value="David">David</option>
                                <option style="font-family: 'DengXian';" value="DengXian">DengXian</option>
                                <option style="font-family: 'DFKai-SB';" value="DFKai-SB">DFKai-SB</option>
                                <option style="font-family: 'Didot';" value="Didot">Didot</option>
                                <option style="font-family: 'DilleniaUPC';" value="DilleniaUPC">DilleniaUPC</option>
                                <option style="font-family: 'DokChampa';" value="DokChampa">DokChampa</option>
                                <option style="font-family: 'Dotum';" value="Dotum">Dotum</option>
                                <option style="font-family: 'DotumChe';" value="DotumChe">DotumChe</option>
                                <option style="font-family: 'Ebrima';" value="Ebrima">Ebrima</option>
                                <option style="font-family: 'Estrangelo Edessa';" value="Estrangelo Edessa">Estrangelo
                                    Edessa
                                </option>
                                <option style="font-family: 'EucrosiaUPC';" value="EucrosiaUPC">EucrosiaUPC</option>
                                <option style="font-family: 'Euphemia';" value="Euphemia">Euphemia</option>
                                <option style="font-family: 'FangSong';" value="FangSong">FangSong</option>
                                <option style="font-family: 'Florence';" value="Florence">Florence</option>
                                <option style="font-family: 'Franklin Gothic Medium';" value="Franklin Gothic Medium">
                                    Franklin Gothic Medium
                                </option>
                                <option style="font-family: 'FrankRuehl';" value="FrankRuehl">FrankRuehl</option>
                                <option style="font-family: 'FreesiaUPC';" value="FreesiaUPC">FreesiaUPC</option>
                                <option style="font-family: 'Futara';" value="Futara">Futara</option>
                                <option style="font-family: 'Gabriola';" value="Gabriola">Gabriola</option>
                                <option style="font-family: 'Gadugi';" value="Gadugi">Gadugi</option>
                                <option style="font-family: 'Garamond';" value="Garamond">Garamond</option>
                                <option style="font-family: 'Gautami';" value="Gautami">Gautami</option>
                                <option style="font-family: 'Geneva';" value="Geneva">Geneva</option>
                                <option style="font-family: 'Georgia';" value="Georgia">Georgia</option>
                                <option style="font-family: 'Georgia Pro';" value="Georgia Pro">Georgia Pro</option>
                                <option style="font-family: 'Gill Sans';" value="Gill Sans">Gill Sans</option>
                                <option style="font-family: 'Gill Sans Nova';" value="Gill Sans Nova">Gill Sans Nova
                                </option>
                                <option style="font-family: 'Gisha';" value="Gisha">Gisha</option>
                                <option style="font-family: 'Goudy Old Style';" value="Goudy Old Style">Goudy Old Style
                                </option>
                                <option style="font-family: 'Gulim';" value="Gulim">Gulim</option>
                                <option style="font-family: 'GulimChe';" value="GulimChe">GulimChe</option>
                                <option style="font-family: 'Gungsuh';" value="Gungsuh">Gungsuh</option>
                                <option style="font-family: 'GungsuhChe';" value="GungsuhChe">GungsuhChe</option>
                                <option style="font-family: 'Hebrew';" value="Hebrew">Hebrew</option>
                                <option style="font-family: 'Helvetica';" value="Helvetica">Helvetica</option>
                                <option style="font-family: 'Hoefler Text';" value="Hoefler Text">Hoefler Text</option>
                                <option style="font-family: 'HoloLens MDL2 Assets';" value="HoloLens MDL2 Assets">
                                    HoloLens
                                    MDL2 Assets
                                </option>
                                <option style="font-family: 'Impact';" value="Impact">Impact</option>
                                <option style="font-family: 'Ink Free';" value="Ink Free">Ink Free</option>
                                <option style="font-family: 'IrisUPC';" value="IrisUPC">IrisUPC</option>
                                <option style="font-family: 'Iskoola Pota';" value="Iskoola Pota">Iskoola Pota</option>
                                <option style="font-family: 'Japanese';" value="Japanese">Japanese</option>
                                <option style="font-family: 'JasmineUPC';" value="JasmineUPC">JasmineUPC</option>
                                <option style="font-family: 'Javanese Text';" value="Javanese Text">Javanese Text
                                </option>
                                <option style="font-family: 'Jazz LET';" value="Jazz LET">Jazz LET</option>
                                <option style="font-family: 'KaiTi';" value="KaiTi">KaiTi</option>
                                <option style="font-family: 'Kalinga';" value="Kalinga">Kalinga</option>
                                <option style="font-family: 'Kartika';" value="Kartika">Kartika</option>
                                <option style="font-family: 'Khmer UI';" value="Khmer UI">Khmer UI</option>
                                <option style="font-family: 'KodchiangUPC';" value="KodchiangUPC">KodchiangUPC</option>
                                <option style="font-family: 'Kokila';" value="Kokila">Kokila</option>
                                <option style="font-family: 'Lao';" value="Lao">Lao</option>
                                <option style="font-family: 'Lao UI';" value="Lao UI">Lao UI</option>
                                <option style="font-family: 'Latha';" value="Latha">Latha</option>
                                <option style="font-family: 'Leelawadee';" value="Leelawadee">Leelawadee</option>
                                <option style="font-family: 'Leelawadee UI';" value="Leelawadee UI">Leelawadee UI
                                </option>
                                <option style="font-family: 'Leelawadee UI Semilight';" value="Leelawadee UI Semilight">
                                    Leelawadee UI Semilight
                                </option>
                                <option style="font-family: 'Levenim MT';" value="Levenim MT">Levenim MT</option>
                                <option style="font-family: 'LilyUPC';" value="LilyUPC">LilyUPC</option>
                                <option style="font-family: 'Lucida Bright';" value="Lucida Bright">Lucida Bright
                                </option>
                                <option style="font-family: 'Lucida Bright';" value="Lucida Bright">Lucida Bright
                                </option>
                                <option style="font-family: 'Lucida Console';" value="Lucida Console">Lucida Console
                                </option>
                                <option style="font-family: 'Lucida Handwriting';" value="Lucida Handwriting">Lucida
                                    Handwriting
                                </option>
                                <option style="font-family: 'Lucida Sans';" value="Lucida Sans">Lucida Sans</option>
                                <option style="font-family: 'Lucida Sans Typewriter';" value="Lucida Sans Typewriter">
                                    Lucida
                                    Sans Typewriter
                                </option>
                                <option style="font-family: 'Lucida Sans Unicode';" value="Lucida Sans Unicode">Lucida
                                    Sans
                                    Unicode
                                </option>
                                <option style="font-family: 'Lucidatypewriter';" value="Lucidatypewriter">
                                    Lucidatypewriter
                                </option>
                                <option style="font-family: 'Luminari';" value="Luminari">Luminari</option>
                                <option style="font-family: 'Malgun Gothic';" value="Malgun Gothic">Malgun Gothic
                                </option>
                                <option style="font-family: 'Malgun Gothic Semilight';" value="Malgun Gothic Semilight">
                                    Malgun Gothic Semilight
                                </option>
                                <option style="font-family: 'Mangal';" value="Mangal">Mangal</option>
                                <option style="font-family: 'Meiryo';" value="Meiryo">Meiryo</option>
                                <option style="font-family: 'Meiryo UI';" value="Meiryo UI">Meiryo UI</option>
                                <option style="font-family: 'Microsoft Himalaya';" value="Microsoft Himalaya">Microsoft
                                    Himalaya
                                </option>
                                <option style="font-family: 'Microsoft JhengHei';" value="Microsoft JhengHei">Microsoft
                                    JhengHei
                                </option>
                                <option style="font-family: 'Microsoft JhengHei UI';" value="Microsoft JhengHei UI">
                                    Microsoft JhengHei UI
                                </option>
                                <option style="font-family: 'Microsoft New Tai Lue';" value="Microsoft New Tai Lue">
                                    Microsoft New Tai Lue
                                </option>
                                <option style="font-family: 'Microsoft PhagsPa';" value="Microsoft PhagsPa">Microsoft
                                    PhagsPa
                                </option>
                                <option style="font-family: 'Microsoft Sans Serif';" value="Microsoft Sans Serif">
                                    Microsoft
                                    Sans Serif
                                </option>
                                <option style="font-family: 'Microsoft Tai Le';" value="Microsoft Tai Le">Microsoft Tai
                                    Le
                                </option>
                                <option style="font-family: 'Microsoft Uighur';" value="Microsoft Uighur">Microsoft
                                    Uighur
                                </option>
                                <option style="font-family: 'Microsoft YaHei';" value="Microsoft YaHei">Microsoft YaHei
                                </option>
                                <option style="font-family: 'Microsoft YaHei UI';" value="Microsoft YaHei UI">Microsoft
                                    YaHei UI
                                </option>
                                <option style="font-family: 'Microsoft Yi Baiti';" value="Microsoft Yi Baiti">Microsoft
                                    Yi
                                    Baiti
                                </option>
                                <option style="font-family: 'MingLiU';" value="MingLiU">MingLiU</option>
                                <option style="font-family: 'MingLiU_HKSCS';" value="MingLiU_HKSCS">MingLiU_HKSCS
                                </option>
                                <option style="font-family: 'MingLiU_HKSCS-ExtB';" value="MingLiU_HKSCS-ExtB">
                                    MingLiU_HKSCS-ExtB
                                </option>
                                <option style="font-family: 'MingLiU-ExtB';" value="MingLiU-ExtB">MingLiU-ExtB</option>
                                <option style="font-family: 'Miriam';" value="Miriam">Miriam</option>
                                <option style="font-family: 'Monaco';" value="Monaco">Monaco</option>
                                <option style="font-family: 'Mongolian Baiti';" value="Mongolian Baiti">Mongolian Baiti
                                </option>
                                <option style="font-family: 'MoolBoran';" value="MoolBoran">MoolBoran</option>
                                <option style="font-family: 'MS Gothic';" value="MS Gothic">MS Gothic</option>
                                <option style="font-family: 'MS Mincho';" value="MS Mincho">MS Mincho</option>
                                <option style="font-family: 'MS PGothic';" value="MS PGothic">MS PGothic</option>
                                <option style="font-family: 'MS PMincho';" value="MS PMincho">MS PMincho</option>
                                <option style="font-family: 'MS UI Gothic';" value="MS UI Gothic">MS UI Gothic</option>
                                <option style="font-family: 'MV Boli';" value="MV Boli">MV Boli</option>
                                <option style="font-family: 'Myanmar Text';" value="Myanmar Text">Myanmar Text</option>
                                <option style="font-family: 'Narkisim';" value="Narkisim">Narkisim</option>
                                <option style="font-family: 'Neue Haas Grotesk Text Pro';"
                                        value="Neue Haas Grotesk Text Pro">Neue Haas Grotesk Text Pro
                                </option>
                                <option style="font-family: 'New Century Schoolbook';" value="New Century Schoolbook">
                                    New
                                    Century Schoolbook
                                </option>
                                <option style="font-family: 'News Gothic MT';" value="News Gothic MT">News Gothic MT
                                </option>
                                <option style="font-family: 'Nirmala UI';" value="Nirmala UI">Nirmala UI</option>
                                <option style="font-family: 'No automatic language associations';"
                                        value="No automatic language associations">No automatic language associations
                                </option>
                                <option style="font-family: 'Noto';" value="Noto">Noto</option>
                                <option style="font-family: 'NSimSun';" value="NSimSun">NSimSun</option>
                                <option style="font-family: 'Nyala';" value="Nyala">Nyala</option>
                                <option style="font-family: 'Oldtown';" value="Oldtown">Oldtown</option>
                                <option style="font-family: 'Optima';" value="Optima">Optima</option>
                                <option style="font-family: 'Palatino';" value="Palatino">Palatino</option>
                                <option style="font-family: 'Palatino Linotype';" value="Palatino Linotype">Palatino
                                    Linotype
                                </option>
                                <option style="font-family: 'papyrus';" value="papyrus">papyrus</option>
                                <option style="font-family: 'Parkavenue';" value="Parkavenue">Parkavenue</option>
                                <option style="font-family: 'Perpetua';" value="Perpetua">Perpetua</option>
                                <option style="font-family: 'Plantagenet Cherokee';" value="Plantagenet Cherokee">
                                    Plantagenet Cherokee
                                </option>
                                <option style="font-family: 'PMingLiU';" value="PMingLiU">PMingLiU</option>
                                <option style="font-family: 'Raavi';" value="Raavi">Raavi</option>
                                <option style="font-family: 'Rockwell';" value="Rockwell">Rockwell</option>
                                <option style="font-family: 'Rockwell Extra Bold';" value="Rockwell Extra Bold">Rockwell
                                    Extra Bold
                                </option>
                                <option style="font-family: 'Rockwell Nova';" value="Rockwell Nova">Rockwell Nova
                                </option>
                                <option style="font-family: 'Rockwell Nova Cond';" value="Rockwell Nova Cond">Rockwell
                                    Nova
                                    Cond
                                </option>
                                <option style="font-family: 'Rockwell Nova Extra Bold';"
                                        value="Rockwell Nova Extra Bold">
                                    Rockwell Nova Extra Bold
                                </option>
                                <option style="font-family: 'Rod';" value="Rod">Rod</option>
                                <option style="font-family: 'Sakkal Majalla';" value="Sakkal Majalla">Sakkal Majalla
                                </option>
                                <option style="font-family: 'Sanskrit Text';" value="Sanskrit Text">Sanskrit Text
                                </option>
                                <option style="font-family: 'Segoe MDL2 Assets';" value="Segoe MDL2 Assets">Segoe MDL2
                                    Assets
                                </option>
                                <option style="font-family: 'Segoe Print';" value="Segoe Print">Segoe Print</option>
                                <option style="font-family: 'Segoe Script';" value="Segoe Script">Segoe Script</option>
                                <option style="font-family: 'Segoe UI';" value="Segoe UI">Segoe UI</option>
                                <option style="font-family: 'Segoe UI Emoji';" value="Segoe UI Emoji">Segoe UI Emoji
                                </option>
                                <option style="font-family: 'Segoe UI Historic';" value="Segoe UI Historic">Segoe UI
                                    Historic
                                </option>
                                <option style="font-family: 'Segoe UI Symbol';" value="Segoe UI Symbol">Segoe UI Symbol
                                </option>
                                <option style="font-family: 'Shonar Bangla';" value="Shonar Bangla">Shonar Bangla
                                </option>
                                <option style="font-family: 'Shruti';" value="Shruti">Shruti</option>
                                <option style="font-family: 'SimHei';" value="SimHei">SimHei</option>
                                <option style="font-family: 'SimKai';" value="SimKai">SimKai</option>
                                <option style="font-family: 'Simplified Arabic';" value="Simplified Arabic">Simplified
                                    Arabic
                                </option>
                                <option style="font-family: 'Simplified Chinese';" value="Simplified Chinese">Simplified
                                    Chinese
                                </option>
                                <option style="font-family: 'SimSun';" value="SimSun">SimSun</option>
                                <option style="font-family: 'SimSun-ExtB';" value="SimSun-ExtB">SimSun-ExtB</option>
                                <option style="font-family: 'Sitka';" value="Sitka">Sitka</option>
                                <option style="font-family: 'Snell Roundhan';" value="Snell Roundhan">Snell Roundhan
                                </option>
                                <option style="font-family: 'Stencil Std';" value="Stencil Std">Stencil Std</option>
                                <option style="font-family: 'Sylfaen';" value="Sylfaen">Sylfaen</option>
                                <option style="font-family: 'Symbol';" value="Symbol">Symbol</option>
                                <option style="font-family: 'Tahoma';" value="Tahoma">Tahoma</option>
                                <option style="font-family: 'Thai';" value="Thai">Thai</option>
                                <option style="font-family: 'Times New Roman';" value="Times New Roman">Times New Roman
                                </option>
                                <option style="font-family: 'Traditional Arabic';" value="Traditional Arabic">
                                    Traditional
                                    Arabic
                                </option>
                                <option style="font-family: 'Traditional Chinese';" value="Traditional Chinese">
                                    Traditional
                                    Chinese
                                </option>
                                <option style="font-family: 'Trattatello';" value="Trattatello">Trattatello</option>
                                <option style="font-family: 'Trebuchet MS';" value="Trebuchet MS">Trebuchet MS</option>
                                <option style="font-family: 'Tunga';" value="Tunga">Tunga</option>
                                <option style="font-family: 'UD Digi Kyokasho';" value="UD Digi Kyokasho">UD Digi
                                    Kyokasho
                                </option>
                                <option style="font-family: 'UD Digi KyoKasho NK-R';" value="UD Digi KyoKasho NK-R">UD
                                    Digi
                                    KyoKasho NK-R
                                </option>
                                <option style="font-family: 'UD Digi KyoKasho NP-R';" value="UD Digi KyoKasho NP-R">UD
                                    Digi
                                    KyoKasho NP-R
                                </option>
                                <option style="font-family: 'UD Digi KyoKasho N-R';" value="UD Digi KyoKasho N-R">UD
                                    Digi
                                    KyoKasho N-R
                                </option>
                                <option style="font-family: 'Urdu Typesetting';" value="Urdu Typesetting">Urdu
                                    Typesetting
                                </option>
                                <option style="font-family: 'URW Chancery';" value="URW Chancery">URW Chancery</option>
                                <option style="font-family: 'Utsaah';" value="Utsaah">Utsaah</option>
                                <option style="font-family: 'Vani';" value="Vani">Vani</option>
                                <option style="font-family: 'Verdana';" value="Verdana">Verdana</option>
                                <option style="font-family: 'Verdana Pro';" value="Verdana Pro">Verdana Pro</option>
                                <option style="font-family: 'Vijaya';" value="Vijaya">Vijaya</option>
                                <option style="font-family: 'Vrinda';" value="Vrinda">Vrinda</option>
                                <option style="font-family: 'Westminster';" value="Westminster">Westminster</option>
                                <option style="font-family: 'Yu Gothic';" value="Yu Gothic">Yu Gothic</option>
                                <option style="font-family: 'Yu Gothic UI';" value="Yu Gothic UI">Yu Gothic UI</option>
                                <option style="font-family: 'Yu Mincho';" value="Yu Mincho">Yu Mincho</option>
                                <option style="font-family: 'Zapf Chancery';" value="Zapf Chancery">Zapf Chancery
                                </option>
                            </select>
                            <select id="font_size_selector"
                                    style="font-size: 12px; outline: none; height: 25px; margin-right: 7px;">
                                <option value='6'>6</option>
                                <option value='8'>8</option>
                                <option value='10'>10</option>
                                <option value='12'>12</option>
                                <option value='14'>14</option>
                                <option value='16' selected="selected">16</option>
                                <option value='18'>18</option>
                                <option value='20'>20</option>
                                <option value='22'>22</option>
                                <option value='24'>24</option>
                                <option value='26'>26</option>
                                <option value='28'>28</option>
                                <option value='30'>30</option>
                                <option value='32'>32</option>
                                <option value='34'>34</option>
                                <option value='36'>36</option>
                                <option value='38'>38</option>
                                <option value='40'>40</option>
                                <option value='42'>42</option>
                                <option value='44'>44</option>
                                <option value='46'>46</option>
                                <option value='48'>48</option>
                                <option value='50'>50</option>
                                <option value='52'>52</option>
                                <option value='54'>54</option>
                                <option value='56'>56</option>
                                <option value='58'>58</option>
                                <option value='60'>60</option>
                                <option value='62'>62</option>
                                <option value='64'>64</option>
                                <option value='66'>66</option>
                                <option value='68'>68</option>
                                <option value='70'>70</option>
                                <option value='72'>72</option>
                                <option value='74'>74</option>
                                <option value='76'>76</option>
                                <option value='78'>78</option>
                                <option value='80'>80</option>
                                <option value='82'>82</option>
                                <option value='84'>84</option>
                                <option value='88'>88</option>
                                <option value='90'>90</option>
                                <option value='92'>92</option>
                                <option value='94'>94</option>
                                <option value='96'>96</option>
                                <option value='98'>98</option>
                                <option value='100'>100</option>
                            </select>
                            <div>
                                <button class="button" id="font_size_bigger_btn"
                                        style="padding: 7px;height: 25px; background-image: url('{{ url('/images/ribbon_imgs/home-8.png') }}'); background-repeat: no-repeat; background-position-x: center;background-position-y: center;"></button>
                                <button class="button" id="font_size_smaller_btn"
                                        style="padding: 7px;height: 25px; background-image: url('{{ url('/images/ribbon_imgs/home-9.png') }}'); background-repeat: no-repeat; background-position-x: center;background-position-y: center;"></button>
                                <button class="button" id="font_style_clear_btn"
                                        style="padding: 7px;height: 25px; background-image: url('{{ url('/images/ribbon_imgs/home-10.png') }}'); background-repeat: no-repeat; background-position-x: center;background-position-y: center;"></button>
                            </div>
                        </div>
                        <div style="display: flex;">
                            <div>
                                <button id="slide_view_font_bold_btn" class="button font_bold_btn"
                                        style="background-image: url('{{ url('/images/ribbon_imgs/home/bold.png') }}'); background-repeat: no-repeat; background-position-x: center;background-position-y: center;
                                            "></button>
                                <button id="slide_view_font_ital_btn" class="button font_ital_btn"
                                        style="background-image: url('{{ url('/images/ribbon_imgs/home/ital.png') }}'); background-repeat: no-repeat; background-position-x: center;background-position-y: center;
                                            "></button>
                                <button id="slide_view_font_underline_btn" class="button font_underline_btn"
                                        style="background-image: url('{{ url('/images/ribbon_imgs/home/under.png') }}'); background-repeat: no-repeat; background-position-x: center;background-position-y: center;"></button>
                                <button id="slide_view_font_strike_btn" class="button font_strike_btn"
                                        style="background-image: url('{{ url('/images/ribbon_imgs/home/strike.png') }}'); background-repeat: no-repeat; background-position-x: center;background-position-y: center;"></button>
                            </div>
                        </div>
                        <div style=" display: flex; margin-left: 10px;">
                            <div data-role=" buttongroup" style="margin-left: 11px; ">
                                <button id="slide_view_font_subscription_btn" class="button font_subscription_btn"
                                        style="background-image: url('{{ url('/images/ribbon_imgs/home/sub.png') }}'); background-repeat: no-repeat; background-position-x: center;background-position-y: center;
                                            "></button>
                                <button id="slide_view_font_superscription_btn" class=" button font_superscription_btn"
                                        style="background-image: url('{{ url('/images/ribbon_imgs/home/sup.png') }}'); background-repeat: no-repeat; background-position-x: center;background-position-y: center;
                                            "></button>
                            </div>
                        </div>
                        <div>
                            <span id="font_color_display_letter"
                                  style="margin-right: -3px; border-bottom: 2px solid black;">A</span>
                            <button class="dropdown-toggle" id="font_picker_trigger"
                                    style="background: #f5f6f7; border: none; padding: 0"></button>
                            <!-- <input type="color" name="" id="font_color_picker"> -->
                            <div id="office_color_picker" class="ribbon-dropdown" data-role="dropdown"
                                 data-duration="100"
                                 style="position: absolute;">
                            </div>
                        </div>
                        <span class=" title">Font</span>
                        <div class="group-divider"></div>
                    </div>
                    <div class="group" style="flex: 0 0 200px;">
                        <div>
                            <div>
                                <button class="button bullet_btn" id="slide_view_paragraph_style_bullet_btn"
                                        style="padding: 7px;height: 25px; background-image: url('{{ url('/images/ribbon_imgs/home-11.png') }}'); background-repeat: no-repeat; background-position-x: center;background-position-y: center;"></button>
                                <button class="button numbering_btn" id="slide_view_paragraph_style_numbering_btn"
                                        style="padding: 7px;height: 25px; background-image: url('{{ url('/images/ribbon_imgs/home-12.png') }}'); background-repeat: no-repeat; background-position-x: center;background-position-y: center;"></button>
                                <button class="button decrease_indent"
                                        id="slide_view_paragraph_style_decrease_indent_btn"
                                        style="padding: 7px;height: 25px; background-image: url('{{ url('/images/ribbon_imgs/home-13.png') }}'); background-repeat: no-repeat; background-position-x: center;background-position-y: center;"></button>
                                <button class="button increase_indent"
                                        id="slide_view_paragraph_style_increase_indent_btn"
                                        style="padding: 7px;height: 25px; background-image: url('{{ url('/images/ribbon_imgs/home-14.png') }}'); background-repeat: no-repeat; background-position-x: center;background-position-y: center;"></button>
                            </div>
                            <div>
                                <button class="button" id="paragraph_align_left"
                                        style="padding: 7px;height: 25px; background-image: url('{{ url('/images/ribbon_imgs/home-15.png') }}'); background-repeat: no-repeat; background-position-x: center;background-position-y: center;"></button>
                                <button class="button" id="paragraph_align_center"
                                        style="padding: 7px;height: 25px; background-image: url('{{ url('/images/ribbon_imgs/home-16.png') }}'); background-repeat: no-repeat; background-position-x: center;background-position-y: center;"></button>
                                <button class="button" id="paragraph_align_right"
                                        style="padding: 7px;height: 25px; background-image: url('{{ url('/images/ribbon_imgs/home-17.png') }}'); background-repeat: no-repeat; background-position-x: center;background-position-y: center;"></button>
                                <button class="button" id="paragraph_align_justify"
                                        style="padding: 7px;height: 25px; background-image: url('{{ url('/images/ribbon_imgs/home-18.png') }}'); background-repeat: no-repeat; background-position-x: center;background-position-y: center;"></button>
                            </div>
                        </div>
                        <div class="dropdown-button">
                            <button class="button dropdown-toggle" id="line_height_selector"
                                    style="margin-left: 10px; width: 44px; height: 23px; background-image: url({{ url("/images/ribbon_imgs/home-19.png") }}); background-repeat: no-repeat; background-position-y: center; background-position-x: 5px;"></button>
                            <ul class="ribbon-dropdown" data-role="dropdown" data-duration="100"
                                style="transform: translate(10px, -10px);">
                                <li id="paragraph_line_spacing_100"><a>1,0</a></li>
                                <li id="paragraph_line_spacing_115"><a>1,15</a></li>
                                <li id="paragraph_line_spacing_150"><a>1,5</a></li>
                                <li id="paragraph_line_spacing_200"><a>2,0</a></li>
                                <!-- <li id="paragraph_line_spacing_option"><a>Spacing Options</a></li> -->
                                <li class="list_divider"></li>
                                <li id="paragraph_line_spacing_add_before"><a>Add Space Before Paragraph</a></li>
                                <li id="paragraph_line_spacing_add_after"><a>Add Space After Paragraph</a></li>
                            </ul>
                        </div>
                        <span class="title">Paragraph</span>
                        <div class="group-divider"></div>
                    </div>
                    <div class="group">
                        <div class="ribbon-split-button">
                            <button class="ribbon-main" id="slideview_arrange_btn_top">
                            <span class="icon">
                                <img loading="lazy" src="{{ url("/images/ribbon_imgs/home-20.png") }}">
                            </span>
                            </button>
                            <span class="ribbon-split dropdown-toggle" id="slideview_arrange_btn_down">Arrange</span>
                            <ul id="arrange_ul" class="ribbon-dropdown" data-role="dropdown" data-duration="100">
                                <li class="subtitle_li">Order Objects</li>
                                <li style="background-image: url({{ url("/images/ribbon_imgs/arrange_bring_to_front.png") }});"
                                    id="arrange_bring_front"><a>Bring to Front</a></li>
                                <li style="background-image: url({{ url("/images/ribbon_imgs/arrange_send_to_back.png") }});"
                                    id="arrange_send_back"><a>Send to Back</a></li>
                                <li style="background-image: url({{ url("/images/ribbon_imgs/arrange_bring_forward.png") }});"
                                    id="arrange_bring_forward"><a>Bring Forward</a></li>
                                <li style="background-image: url({{ url("/images/ribbon_imgs/arrange_send_backward.png") }});"
                                    id="arrange_send_backward"><a>Send Backward</a></li>
                                <li class="subtitle_li">Position Objects</li>
                                <li style="background-image: url({{ url("/images/ribbon_imgs/align.png") }});"
                                    id="arrange_li_align"><a>Align <strong
                                            style="position: absolute; right: 5px;">></strong></a>
                                    <ul class="arrange_ul_ul" style=" height: 196px;">
                                        <li style="background-image: url({{ url("/images/ribbon_imgs/align_left.png") }});"
                                            id="align_left"><a>Align Left</a></li>
                                        <li style="background-image: url({{ url("/images/ribbon_imgs/align_center.png") }});"
                                            id="align_center"><a>Align Center</a></li>
                                        <li style="background-image: url({{ url("/images/ribbon_imgs/align_right.png") }});"
                                            id="align_right"><a>Align Right</a></li>
                                        <li style="background-image: url({{ url("/images/ribbon_imgs/align_top.png") }});"
                                            id="align_top"><a>Align Top</a></li>
                                        <li style="background-image: url({{ url("/images/ribbon_imgs/align_middle.png") }});"
                                            id="align_middle"><a>Align Middle</a></li>
                                        <li style="background-image: url({{ url("/images/ribbon_imgs/align_bottom.png") }});"
                                            id="align_bottom"><a>Align Bottom</a></li>
                                        <li style="background-image: url({{ url("/images/ribbon_imgs/distribute_horizontally.png") }});"
                                            id="distribute_horizontally"><a>Distribute Horizontally</a></li>
                                        <li style="background-image: url({{ url("/images/ribbon_imgs/distribute_vertically.png") }});"
                                            id="distribute_vertically"><a>Distribute Vertically</a></li>
                                    <!-- <li style="background-image: url({{ url("/images/ribbon_imgs/checked.png") }});"
                                        id="align_to_slide"><a>Align to Slide</a></li>
                                    <li id="align_to_selected_obj"><a>Align Selected Objects</a></li> -->
                                    </ul>
                                </li>
                            <!--                                 <li style="background-image: url({{ url("/images/ribbon_imgs/rotate.png") }});"
                                    id="arrange_li_rotate"><a>Rotate <strong
                                            style="position: absolute; right: 5px;">></strong></a>
                                    <ul class="arrange_ul_ul" style="height: 52px;">
                                        <li style="background-image: url({{ url("/images/ribbon_imgs/rotate_right.png") }});"
                                            id="rotate_right"><a>Rotate Right</a></li>
                                        <li style="background-image: url({{ url("/images/ribbon_imgs/rotate_left.png") }});"
                                            id="rotate_left"><a>Rotate Left</a></li>
                                        <li id="rotate_options"><a>More Rotation Options...</a></li>
                                    </ul>
                                </li> -->
                            </ul>
                        </div>
                        <div class="ribbon-split-button">
                            <button class="ribbon-main" id="slideview_quick_styles_btn_top">
                            <span class="icon">
                                <img loading="lazy" src="{{ url("/images/ribbon_imgs/home-21.png") }}">
                            </span>
                            </button>
                            <span class="ribbon-split dropdown-toggle" style="line-height: 1.3;"
                                  id="slideview_quick_styles_btn_bottom">Quick<br>Styles</span>
                            <div id="quick_styles_panel_holder" class="ribbon-dropdown" data-role="dropdown"
                                 data-duration="100">
                                <div>
                                    <div class='quick_style_sample_divider'>None</div>
                                    <div>
                                        <div class="quick_style_sample_none" id="quick_style_none"
                                             style="border: 3px solid #2b2b2b; background: #ffffff; color: #2b2b2b">
                                            <span>Abc</span></div>
                                    </div>
                                    <div class='quick_style_sample_divider'>Presets</div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #2b2b2b; background: #ffffff; color: #2b2b2b">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #959595; background: #ffffff; color: #2b2b2b">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #df4047; background: #ffffff; color: #2b2b2b">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #e97624; background: #ffffff; color: #2b2b2b">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #60b952; background: #ffffff; color: #2b2b2b">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #5a97d6; background: #ffffff; color: #2b2b2b">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #319cbc; background: #ffffff; color: #2b2b2b">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #0f0f0f; background: #2b2b2b; color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #7b7b7b; background: #959595; color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #b9262e; background: #df4047; color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #c56014; background: #e97624; color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #509b40; background: #60b952; color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #4575a0; background: #5a97d6; color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #367b96; background: #319cbc; color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #2b2b2b; background: #2b2b2b; color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #959595; background: #959595; color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #df4047; background: #df4047; color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #e97624; background: #e97624; color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #60b952; background: #60b952; color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #5a97d6; background: #5a97d6; color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #319cbc; background: #319cbc; color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #2b2b2b; background: linear-gradient(#929292, #5f5f5f); color: #2b2b2b">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #959595; background: linear-gradient(#d1d1d1, #c1c1c1); color: #2b2b2b">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #d73d43; background: linear-gradient(#ebacb0, #e28d92); color: #2b2b2b">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #e97624; background: linear-gradient(#f2c199, #eaae7b); color: #2b2b2b">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #60b952; background: linear-gradient(#bfe2b8, #a7d79c); color: #2b2b2b">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #5a97d6; background: linear-gradient(#cfdff2, #b0cbeb); color: #2b2b2b">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #319cbc; background: linear-gradient(#81c1d6, #6eb1cb); color: #2b2b2b">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #2b2b2b; background: linear-gradient(#3e3e3e, #040404); color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #7b7b7b; background: linear-gradient(#959595, #8b8b8b); color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #b9262e; background: linear-gradient(#df4047, #cc2a30); color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #e27520; background: linear-gradient(#e27520, #cd6c18); color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #579c45; background: linear-gradient(#69ba57, #63b350); color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #4679c9; background: linear-gradient(#6497d5, #5d8bcf); color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: 3px solid #319cbc; background: linear-gradient(#459cbc, #4b8fae); color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: none; box-shadow: 1px 1px 3px grey; background: linear-gradient(#3e3e3e, #040404); color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: none; box-shadow: 1px 1px 3px grey; background: linear-gradient(#959595, #8b8b8b); color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: none; box-shadow: 1px 1px 3px grey; background: linear-gradient(#df4047, #cc2a30); color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: none; box-shadow: 1px 1px 3px grey; background: linear-gradient(#e27520, #cd6c18); color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: none; box-shadow: 1px 1px 3px grey; background: linear-gradient(#69ba57, #63b350); color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: none; box-shadow: 1px 1px 3px grey; background: linear-gradient(#6497d5, #5d8bcf); color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: none; box-shadow: 1px 1px 3px grey; background: linear-gradient(#459cbc, #4b8fae); color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: none; background: repeating-conic-gradient(#585858 0deg 90deg, #646464 0 180deg) 0 0/25% 25%; color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: none; background: repeating-conic-gradient(#a2a2a2 0deg 90deg, #aeaeae 0 180deg) 0 0/25% 25%; color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: none; background: repeating-conic-gradient(#d5666b 0deg 90deg, #e27378 0 180deg) 0 0/25% 25%; color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: none; background: repeating-conic-gradient(#dc8d53 0deg 90deg, #e9995f 0 180deg) 0 0/25% 25%; color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: none; background: repeating-conic-gradient(#7dbb73 0deg 90deg, #89c780 0 180deg) 0 0/25% 25%; color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: none; background: repeating-conic-gradient(#78a3cf 0deg 90deg, #85b0dc 0 180deg) 0 0/25% 25%; color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                    <div>
                                        <div class="quick_style_sample"
                                             style="border: none; background: repeating-conic-gradient(#5ca7bd 0deg 90deg, #69b3ca 0 180deg) 0 0/25% 25%; color: #ffffff">
                                            <span>Abc</span></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div style="display: flex; flex-direction: column;">
                            <button class="ribbon-icon-button">
                            <span class="icon">
                                <img loading="lazy" src="{{ url("/images/ribbon_imgs/home-22.png") }}">
                            </span>
                                <span class="caption dropdown-toggle">Shape Fill</span>
                                <div id="shape_fill_color_picker" class="ribbon-dropdown" data-role="dropdown"
                                     data-duration="100" style="position: absolute;">
                                </div>
                            </button>
                            <button class="ribbon-icon-button">
                            <span class="icon">
                                <img loading="lazy" src="{{ url("/images/ribbon_imgs/home-23.png") }}">
                            </span>
                                <span class="caption dropdown-toggle">Shape Outline</span>
                                <div id="shape_outline_color_picker" class="ribbon-dropdown" data-role="dropdown"
                                     data-duration="100" style="position: absolute;">
                                </div>
                            </button>
                            <button class="ribbon-icon-button">
                            <span class="icon">
                                <img loading="lazy" src="{{ url("/images/ribbon_imgs/home-24.png") }}">
                            </span>
                                <span class="caption dropdown-toggle">Shape Effects</span>
                                <ul id="shape_effects_ul" class="ribbon-dropdown" data-role="dropdown"
                                    data-duration="100">
                                    <li style="background-image: url({{ url("/images/ribbon_imgs/shadow/shadow_item.png") }});"
                                        id="shape_li_shadow"><a>Shadow <strong
                                                style="position: absolute; right: 5px;">></strong></a>
                                        <div id="shape_effect_shadow_panel">
                                            <div>
                                                <div class="shape_effect_shadow_sample_divider">No Shadow</div>
                                                <div class="shape_effect_shadow_sample" id="no_shadow_btn"
                                                     data-style="none"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/shadow/no_shadow.png") }});">
                                                </div>
                                                <div class="shape_effect_shadow_sample_divider">Variations</div>
                                                <div class="shape_effect_shadow_sample"
                                                     data-style="8px 8px 15px 2px rgba(0, 0, 0, 0.55)"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/shadow/Screenshot_11_03.png") }});">
                                                </div>
                                                <div class="shape_effect_shadow_sample"
                                                     data-style="0px 8px 15px 2px rgba(0, 0, 0, 0.55)"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/shadow/Screenshot_11_04.png") }});">
                                                </div>
                                                <div class="shape_effect_shadow_sample"
                                                     data-style="-8px 8px 15px 2px rgba(0, 0, 0, 0.55)"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/shadow/Screenshot_11_05.png") }});">
                                                </div>
                                                <div class="shape_effect_shadow_sample"
                                                     data-style="8px 0px 15px 2px rgba(0, 0, 0, 0.55)"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/shadow/Screenshot_11_07.png") }});">
                                                </div>
                                                <div class="shape_effect_shadow_sample"
                                                     data-style="0px 0px 15px 2px rgba(0, 0, 0, 0.55)"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/shadow/Screenshot_11_08.png") }});">
                                                </div>
                                                <div class="shape_effect_shadow_sample"
                                                     data-style="-8px 0px 15px 2px rgba(0, 0, 0, 0.55)"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/shadow/Screenshot_11_09.png") }});">
                                                </div>
                                                <div class="shape_effect_shadow_sample"
                                                     data-style="8px -8px 15px 2px rgba(0, 0, 0, 0.55)"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/shadow/Screenshot_11_10.png") }});">
                                                </div>
                                                <div class="shape_effect_shadow_sample"
                                                     data-style="0px -8px 15px 2px rgba(0, 0, 0, 0.55)"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/shadow/Screenshot_11_11.png") }});">
                                                </div>
                                                <div class="shape_effect_shadow_sample"
                                                     data-style="-8px -8px 15px 2px rgba(0, 0, 0, 0.55)"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/shadow/Screenshot_11_12.png") }});">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li style="background-image: url({{ url("/images/ribbon_imgs/glow/glowitem.png") }});"
                                        id="shape_li_glow"><a>Glow <strong
                                                style="position: absolute; right: 5px;">></strong></a>
                                        <div id="shape_effect_glow_panel">
                                            <div style="display: flex; flex-wrap: wrap;">
                                                <div class="shape_effect_glow_sample_divider">No Glow</div>
                                                <div class="shape_effect_glow_sample"
                                                     id="no_glow_btn"
                                                     data-style="0px 0px 0px 0px #ffa4a8"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/glow/no_glow.png") }});">
                                                </div>
                                                <div class="shape_effect_glow_sample_divider">Glow Variations</div>
                                                <div class="shape_effect_glow_sample"
                                                     data-style="0px 0px 5px 5px #add2ff"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/glow/Screenshot_10_03.png") }});">
                                                </div>
                                                <div class="shape_effect_glow_sample"
                                                     data-style="0px 0px 5px 5px #ffc699"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/glow/Screenshot_10_04.png") }});">
                                                </div>
                                                <div class="shape_effect_glow_sample"
                                                     data-style="0px 0px 5px 5px #d4d4d4"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/glow/Screenshot_10_05.png") }});">
                                                </div>
                                                <div class="shape_effect_glow_sample"
                                                     data-style="0px 0px 5px 5px #b5e5aa"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/glow/Screenshot_10_06.png") }});">
                                                </div>
                                                <div class="shape_effect_glow_sample"
                                                     data-style="0px 0px 5px 5px #a1e0f7"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/glow/Screenshot_10_07.png") }});">
                                                </div>
                                                <div class="shape_effect_glow_sample"
                                                     data-style="0px 0px 5px 5px #ffa4a8"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/glow/Screenshot_10_08.png") }});">
                                                </div>
                                                <div class="shape_effect_glow_sample"
                                                     data-style="0px 0px 7px 7px #add2ff"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/glow/Screenshot_10_10.png") }});">
                                                </div>
                                                <div class="shape_effect_glow_sample"
                                                     data-style="0px 0px 7px 7px #ffc699"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/glow/Screenshot_10_11.png") }});">
                                                </div>
                                                <div class="shape_effect_glow_sample"
                                                     data-style="0px 0px 7px 7px #d4d4d4"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/glow/Screenshot_10_12.png") }});">
                                                </div>
                                                <div class="shape_effect_glow_sample"
                                                     data-style="0px 0px 7px 7px #b5e5aa"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/glow/Screenshot_10_13.png") }});">
                                                </div>
                                                <div class="shape_effect_glow_sample"
                                                     data-style="0px 0px 7px 7px #a1e0f7"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/glow/Screenshot_10_14.png") }});">
                                                </div>
                                                <div class="shape_effect_glow_sample"
                                                     data-style="0px 0px 7px 7px #ffa4a8"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/glow/Screenshot_10_15.png") }});">
                                                </div>
                                                <div class="shape_effect_glow_sample"
                                                     data-style="0px 0px 9px 9px #add2ff"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/glow/Screenshot_10_16.png") }});">
                                                </div>
                                                <div class="shape_effect_glow_sample"
                                                     data-style="0px 0px 9px 9px #ffc699"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/glow/Screenshot_10_17.png") }});">
                                                </div>
                                                <div class="shape_effect_glow_sample"
                                                     data-style="0px 0px 9px 9px #d4d4d4"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/glow/Screenshot_10_18.png") }});">
                                                </div>
                                                <div class="shape_effect_glow_sample"
                                                     data-style="0px 0px 9px 9px #b5e5aa"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/glow/Screenshot_10_19.png") }});">
                                                </div>
                                                <div class="shape_effect_glow_sample"
                                                     data-style="0px 0px 9px 9px #a1e0f7"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/glow/Screenshot_10_20.png") }});">
                                                </div>
                                                <div class="shape_effect_glow_sample"
                                                     data-style="0px 0px 9px 9px #ffa4a8"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/glow/Screenshot_10_21.png") }});">
                                                </div>
                                                <div class="shape_effect_glow_sample"
                                                     data-style="0px 0px 11px 11px #add2ff"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/glow/Screenshot_10_22.png") }});">
                                                </div>
                                                <div class="shape_effect_glow_sample"
                                                     data-style="0px 0px 11px 11px #ffc699"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/glow/Screenshot_10_23.png") }});">
                                                </div>
                                                <div class="shape_effect_glow_sample"
                                                     data-style="0px 0px 11px 11px #d4d4d4"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/glow/Screenshot_10_24.png") }});">
                                                </div>
                                                <div class="shape_effect_glow_sample"
                                                     data-style="0px 0px 11px 11px #b5e5aa"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/glow/Screenshot_10_25.png") }});">
                                                </div>
                                                <div class="shape_effect_glow_sample"
                                                     data-style="0px 0px 11px 11px #a1e0f7"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/glow/Screenshot_10_26.png") }});">
                                                </div>
                                                <div class="shape_effect_glow_sample"
                                                     data-style="0px 0px 11px 11px #ffa4a8"
                                                     style="background-image: url({{ url("/images/ribbon_imgs/glow/Screenshot_10_27.png") }});">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </button>
                        </div>
                        <span class="title">Drawing</span>
                        <div class="group-divider"></div>
                    </div>
                    <div class="group">
                        {{--                        <a href="{{ url('/exams') }}/{{$exam->id}}/edit">--}}
                        <button class="ribbon-button" id="quiz_properties_btn">
                        <span class="icon">
                            <img loading="lazy" src="{{ url("/images/ribbon_imgs/home-25.png") }}">
                        </span>
                            <span class="caption" style="color: black;">Quiz Properties</span>
                        </button>
                        {{--                        </a>--}}
                        {{--                        <button class="ribbon-button">--}}
                        {{--                        <span class="icon">--}}
                        {{--                            <img loading="lazy" src="{{ url("/images/ribbon_imgs/home-26.png") }}">--}}
                        {{--                        </span>--}}
                        {{--                            <span class="caption">Player</span>--}}
                        {{--                        </button>--}}
                        <span class="title">Quiz</span>
                        <div class="group-divider"></div>
                    </div>
                    <div class="group">
                        <div class="ribbon-split-button">
                            <button class="ribbon-main" id="slideview_home_preview_btn_top">
                            <span class="icon">
                                <img loading="lazy" src="{{ url("/images/ribbon_imgs/home-27.png") }}">
                            </span>
                            </button>
                            <span class="ribbon-split dropdown-toggle">Preview</span>
                            <ul class="ribbon-dropdown" data-role="dropdown" data-duration="100">
                                <li class="design_preview_submenu preview_slide_btn"
                                    id="slideview_home_preview_btn_bottom"
                                    style="background-image: url({{ url("/images/ribbon_imgs/design-pre-1.png") }});">
                                    Preview
                                    Slide
                                </li>
                                <li class="design_preview_submenu preview_group_btn">Preview Group</li>
                                <li class="design_preview_submenu preview_quiz_btn">Preview Quiz</li>
                            </ul>
                        </div>
                    <!-- <button class="ribbon-button">
                        <span class="icon">
                            <img loading="lazy" src="{{ url("/images/ribbon_imgs/home-28.png") }}">
                        </span>
                        <span class="caption">Publish</span>
                    </button> -->
                        <span class="title">Preview</span>
                        <div class="group-divider"></div>
                    </div>
                    <div class="group">
                    </div>
                </div>
                <div class="section" id="section_Home_FormView">
                    <div class="group">
                        <div class="ribbon-split-button">
                            <button class="ribbon-main" id="select_question_btn">
                            <span class="icon">
                                <img src="{{ url("/images/ribbon_imgs/insert-1.png") }}">
                            </span>
                            </button>
                            <span class="ribbon-split dropdown-toggle" id="select_question_dropdown">Question</span>
                            <ul class="ribbon-dropdown" data-role="dropdown" data-duration="100">
                                <div id="quiz_types_panel_2">
                                    <div>
                                        <img class="quiz_types" src="{{ url("/images/ribbon_imgs/slices/1_01.png") }}"
                                             onclick="create_quiz(1, '{{ url('/') }}', '{{ csrf_token() }}')">
                                        <img class="tooltip_pic" src="{{ url("/images/ribbon_imgs/tip_01.png") }}">
                                    </div>
                                    <div>
                                        <img class="quiz_types" src="{{ url("/images/ribbon_imgs/slices/1_02.png") }}"
                                             onclick="create_quiz(2, '{{ url('/') }}', '{{ csrf_token() }}')">
                                        <img class="tooltip_pic" src="{{ url("/images/ribbon_imgs/tip_02.png") }}">
                                    </div>
                                    <div>
                                        <img class="quiz_types" src="{{ url("/images/ribbon_imgs/slices/1_03.png") }}"
                                             onclick="create_quiz(3, '{{ url('/') }}', '{{ csrf_token() }}')">
                                        <img class="tooltip_pic" src="{{ url("/images/ribbon_imgs/tip_03.png") }}">
                                    </div>
                                    <div>
                                        <img class="quiz_types" src="{{ url("/images/ribbon_imgs/slices/1_04.png") }}"
                                             onclick="create_quiz(4, '{{ url('/') }}', '{{ csrf_token() }}')">
                                        <img class="tooltip_pic" src="{{ url("/images/ribbon_imgs/tip_04.png") }}">
                                    </div>
                                    <div>
                                        <img class="quiz_types" src="{{ url("/images/ribbon_imgs/slices/1_05.png") }}"
                                             onclick="create_quiz(5, '{{ url('/') }}', '{{ csrf_token() }}')">
                                        <img class="tooltip_pic" src="{{ url("/images/ribbon_imgs/tip_05.png") }}">
                                    </div>
                                    <div>
                                        <img class="quiz_types" src="{{ url("/images/ribbon_imgs/slices/1_06.png") }}"
                                             onclick="create_quiz(6, '{{ url('/') }}', '{{ csrf_token() }}')">
                                        <img class="tooltip_pic" src="{{ url("/images/ribbon_imgs/tip_06.png") }}">
                                    </div>
                                    <div>
                                        <img class="quiz_types" src="{{ url("/images/ribbon_imgs/slices/1_07.png") }}"
                                             onclick="create_quiz(7, '{{ url('/') }}', '{{ csrf_token() }}')">
                                        <img class="tooltip_pic" src="{{ url("/images/ribbon_imgs/tip_07.png") }}">
                                    </div>
                                    <div>
                                        <img class="quiz_types" src="{{ url("/images/ribbon_imgs/slices/1_08.png") }}"
                                             onclick="create_quiz(8, '{{ url('/') }}', '{{ csrf_token() }}')">
                                        <img class="tooltip_pic" src="{{ url("/images/ribbon_imgs/tip_08.png") }}">
                                    </div>
                                    <div>
                                        <img class="quiz_types" src="{{ url("/images/ribbon_imgs/slices/1_09.png") }}"
                                             onclick="create_quiz(9, '{{ url('/') }}', '{{ csrf_token() }}')">
                                        <img class="tooltip_pic" src="{{ url("/images/ribbon_imgs/tip_09.png") }}">
                                    </div>
                                    <div>
                                        <img class="quiz_types" src="{{ url("/images/ribbon_imgs/slices/1_10.png") }}"
                                             onclick="create_quiz(10, '{{ url('/') }}', '{{ csrf_token() }}')">
                                        <img class="tooltip_pic" src="{{ url("/images/ribbon_imgs/tip_10.png") }}">
                                    </div>
                                    <div>
                                        <img class="quiz_types" src="{{ url("/images/ribbon_imgs/slices/1_11.png") }}"
                                             onclick="create_quiz(11, '{{ url('/') }}', '{{ csrf_token() }}')">
                                        <img class="tooltip_pic" src="{{ url("/images/ribbon_imgs/tip_11.png") }}">
                                    </div>
                                </div>
                            </ul>
                        </div>
                        <div style="display: flex;flex-direction: column;">
                            <button class="ribbon-icon-button info_slide_btn"
                                    onclick="create_quiz(12, '{{ url('/') }}', '{{ csrf_token() }}')">
                            <span class="icon">
                                <img src="{{ url("/images/ribbon_imgs/insert-2.png") }}">
                            </span>
                                <span class="caption">Info Slide</span>
                            </button>
                            <button class="ribbon-icon-button" id="question_group_btn">
                            <span class="icon">
                                <img src="{{ url("/images/ribbon_imgs/home/qgroup.png") }}">
                            </span>
                                <span class="caption">Question Group</span>
                            </button>
                            <button class="ribbon-icon-button" id="introduction_btn">
                            <span class="icon">
                                <img src="{{ url("/images/ribbon_imgs/home/intro.png") }}">
                            </span>
                                <span class="caption dropdown-toggle">Introduction</span>
                                <div class="ribbon-dropdown" data-role="dropdown" data-duration="100"
                                     style="position: absolute; width: 500px;;">
                                    <div style="display: flex;">
                                        <div style="background-color: rgb(71, 114, 255);">
                                            <img class="introduction_slide"
                                                 src="{{ url("/images/ribbon_imgs/home/introduc.png") }}"
                                                 onclick="create_quiz(13, '{{ url('/') }}', '{{ csrf_token() }}')">
                                        </div>
                                    </div>
                                </div>
                            </button>
                        </div>
                        <span class="title">Insert</span>
                        <div class="group-divider"></div>
                    </div>
                    <div class="group">
                        <div style="display: flex;flex-direction: column;">
                            <button class="ribbon-icon-button" id="duplicate_btn">
                            <span class="icon">
                                <img src="{{ url("/images/ribbon_imgs/home/dupli.png") }}">
                            </span>
                                <span class="caption">Duplicate</span>
                            </button>
                            {{--                        <button class="ribbon-icon-button">--}}
                            {{--                            <span class="icon">--}}
                            {{--                                <img loading="lazy" src="{{ url("/images/ribbon_imgs/home/link.png") }}">--}}
                            {{--                            </span>--}}
                            {{--                            <span class="caption dropdown-toggle">Link</span>--}}
                            {{--                            <ul class="ribbon-dropdown" data-role="dropdown" data-duration="100">--}}
                            {{--                                <li class="form_view_home_link"--}}
                            {{--                                    style="background-image: url({{ url("/images/ribbon_imgs/images/Untitled-1_03.png") }});">--}}
                            {{--                                    To--}}
                            {{--                                    Slide Above--}}
                            {{--                                </li>--}}
                            {{--                                <li class="form_view_home_link"--}}
                            {{--                                    style="background-image: url({{ url("/images/ribbon_imgs/images/Untitled-1_05.png") }});
                            border-bottom: 1px dotted grey;">--}}
                            {{--                                    To--}}
                            {{--                                    Slide Below--}}
                            {{--                                </li>--}}
                            {{--                                <li class="form_view_home_link"--}}
                            {{--                                    style="background-image: url({{ url("/images/ribbon_imgs/images/Untitled-1_06.png") }});">--}}
                            {{--                                    To--}}
                            {{--                                    Top of Group--}}
                            {{--                                </li>--}}
                            {{--                                <li class="form_view_home_link"--}}
                            {{--                                    style="background-image: url({{ url("/images/ribbon_imgs/images/Untitled-1_07.png") }});
                            border-bottom: 1px dotted grey;">--}}
                            {{--                                    To--}}
                            {{--                                    Bottom of Group--}}
                            {{--                                </li>--}}
                            {{--                                <li class="form_view_home_link"--}}
                            {{--                                    style="background-image: url({{ url("/images/ribbon_imgs/images/Untitled-1.png") }});"--}}
                            {{--                                    disabled>Unlink--}}
                            {{--                                </li>--}}
                            {{--                            </ul>--}}
                            {{--                        </button>--}}
                            {{--                        <button class="ribbon-icon-button">--}}
                            {{--                            <span class="icon">--}}
                            {{--                                <img loading="lazy" src="{{ url("/images/ribbon_imgs/home/importq.png") }}">--}}
                            {{--                            </span>--}}
                            {{--                            <span class="caption ">Import Questions</span>--}}
                            {{--                        </button>--}}
                        </div>
                        <span class="title">Slide</span>
                        <div class="group-divider"></div>
                    </div>
                    <div class="group">
                        <div style="display: flex;flex-direction: column;">
                            <button id="form_view_cut_btn" class="ribbon-icon-button cut_btn">
                            <span class="icon">
                                <img src="{{ url("/images/ribbon_imgs/home-2.png") }}">
                            </span>
                                <span class="caption">Cut</span>
                            </button>
                            <button id="form_view_copy_btn" class="ribbon-icon-button copy_btn">
                            <span class="icon">
                                <img src="{{ url("/images/ribbon_imgs/home-3.png") }}">
                            </span>
                                <span class="caption">Copy</span>
                            </button>
                            <button id="form_view_paste_btn" class="ribbon-icon-button paste_btn">
                            <span class="icon">
                                <img src="{{ url("/images/ribbon_imgs/home-1.png") }}">
                            </span>
                                <span class="caption">Paste</span>
                            </button>
                        </div>
                        <span class="title">Clipboard</span>
                        <div class="group-divider"></div>
                    </div>
                    <div class="group" style="display: flex; flex-wrap: wrap; flex: 0 0 180px;">
                        <div>
                            <button class="button bullet_btn" id="form_view_paragraph_style_bullet_btn"
                                    style="padding: 7px;height: 25px; background-image: url('{{ url('/images/ribbon_imgs/home-11.png') }}'); background-repeat: no-repeat; background-position-x: center;background-position-y: center;"></button>
                            <button class="button numbering_btn" id="form_view_paragraph_style_numbering_btn"
                                    style="padding: 7px;height: 25px; background-image: url('{{ url('/images/ribbon_imgs/home-12.png') }}'); background-repeat: no-repeat; background-position-x: center;background-position-y: center;"></button>
                            <button class="button decrease_indent" id="form_view_paragraph_style_decrease_indent_btn"
                                    style="padding: 7px;height: 25px; background-image: url('{{ url('/images/ribbon_imgs/home-13.png') }}'); background-repeat: no-repeat; background-position-x: center;background-position-y: center;"></button>
                            <button class="button increase_indent" id="form_view_paragraph_style_increase_indent_btn"
                                    style="padding: 7px;height: 25px; background-image: url('{{ url('/images/ribbon_imgs/home-14.png') }}'); background-repeat: no-repeat; background-position-x: center;background-position-y: center;"></button>
                        </div>
                        <div>
                            <button id="form_view_font_bold_btn" class="button font_bold_btn"
                                    style="background-image: url('{{ url('/images/ribbon_imgs/home/bold.png') }}'); background-repeat: no-repeat; background-position-x: center;background-position-y: center;
                                        "></button>
                            <button id="form_view_font_ital_btn" class="button font_ital_btn"
                                    style="background-image: url('{{ url('/images/ribbon_imgs/home/ital.png') }}'); background-repeat: no-repeat; background-position-x: center;background-position-y: center;
                                        "></button>
                            <button id="form_view_font_underline_btn" class="button font_underline_btn"
                                    style="background-image: url('{{ url('/images/ribbon_imgs/home/under.png') }}'); background-repeat: no-repeat; background-position-x: center;background-position-y: center;
                                        "></button>
                        </div>
                        <div data-role="buttongroup" style="margin-left: 11px;">
                            <button id="form_view_font_subscription_btn" class="button font_subscription_btn"
                                    style="background-image: url('{{ url('/images/ribbon_imgs/home/sub.png') }}'); background-repeat: no-repeat; background-position-x: center;background-position-y: center;
                                        "></button>
                            <button id="form_view_font_superscription_btn" class="button font_superscription_btn"
                                    style="background-image: url('{{ url('/images/ribbon_imgs/home/sup.png') }}'); background-repeat: no-repeat; background-position-x: center;background-position-y: center;
                                        "></button>
                        </div>
                        <span class=" title">Text</span>
                        <div class="group-divider"></div>
                    </div>
                    <div class="group">
                        <div style="display: flex; flex-direction: column; margin-top: 26px;">
                            <button class="ribbon-icon-button hyperlink_btn">
                            <span class="icon">
                                <img src="{{ url("/images/ribbon_imgs/insert-6.png") }}">
                            </span>
                                <span class="caption">Hyperlink</span>
                            </button>
                        </div>
                        <div style="display: flex; flex-direction: column;">
                            <button class="ribbon-icon-button" id="form_view_picture_btn">
                            <span class="icon">
                                <img src="{{ url("/images/ribbon_imgs/insert-3.png") }}">
                            </span>
                                <span class="caption">Picture</span>
                            </button>
                            <input id="form_view_picture_selector" type="file" accept="image/*" data-role="file"
                                   style="display: none;">
                            <button class="ribbon-icon-button" id="form_view_video_file_btn">
                            <span class="icon">
                                <img src="{{ url("/images/ribbon_imgs/insert-9.png") }}">
                            </span>
                                <span class="caption">Video</span>
                            </button>
                            <input id="form_view_video_file_selector" type="file" accept=".mp4, .webm, .ogg"
                                   data-role="file"
                                   style="display: none;">
                            <button class="ribbon-icon-button">
                            <span class="icon">
                                <img src="{{ url("/images/ribbon_imgs/insert-10.png") }}">
                            </span>
                                <span class="caption dropdown-toggle">Audio</span>
                                <ul class="ribbon-dropdown" data-role="dropdown" data-duration="100"
                                    style="width: 150px; text-align: left;">
                                    <li class="insert_audio" id="form_view_import_audio_file_btn"
                                        style="background-image: url({{ url("/images/ribbon_imgs/insert/audio-1.png") }});">
                                        From
                                        File...
                                    </li>
                                    <input id="form_view_audio_selector" type="file" data-role="file"
                                           style="display: none;" accept=".mp3, .wav, .ogg">
                                    <li class="insert_audio" id="form_view_rec_mic_btn"
                                        style="background-image: url({{ url("/images/ribbon_imgs/insert/audio-2.png") }});">
                                        Record Mic...
                                    </li>
                                <!-- <li class="insert_audio" id="form_view_mic_settings_btn"
                                    style="background-image: url({{ url("/images/ribbon_imgs/insert/audio-3.png") }});">
                                    Microphone
                                    Settings
                                </li> -->
                                </ul>
                            </button>
                        </div>
                        <span class="title">Insert</span>
                        <div class="group-divider"></div>
                    </div>
                    <div class="group">
                        <a href="{{ url('/exams') }}/{{$exam->id}}/edit">
                            <button class="ribbon-button">
                        <span class="icon">
                            <img loading="lazy" src="{{ url("/images/ribbon_imgs/home-25.png") }}">
                        </span>
                                <span class="caption" style="color: black;">Quiz Properties</span>
                            </button>
                        </a>
                        {{--                    <button class="ribbon-button">--}}
                        {{--                        <span class="icon">--}}
                        {{--                            <img loading="lazy" src="{{ url("/images/ribbon_imgs/home-26.png") }}">--}}
                        {{--                        </span>--}}
                        {{--                        <span class="caption">Player</span>--}}
                        {{--                    </button>--}}
                        <span class="title">Quiz</span>
                        <div class="group-divider"></div>
                    </div>
                    <div class="group">
                        <div class="ribbon-split-button">
                            <button class="ribbon-main" id="formview_preview_btn">
                            <span class="icon">
                                <img src="{{ url("/images/ribbon_imgs/home-27.png") }}">
                            </span>
                            </button>
                            <span class="ribbon-split dropdown-toggle">Preview</span>
                            <ul class="ribbon-dropdown" data-role="dropdown" data-duration="100">
                                <li class="design_preview_submenu preview_slide_btn" id="formview_preview_dropdown"
                                    style="background-image: url({{ url("/images/ribbon_imgs/design-pre-1.png") }});">
                                    Preview
                                    Slide
                                </li>
                                <li class="design_preview_submenu preview_group_btn">Preview Group</li>
                                <li class="design_preview_submenu preview_quiz_btn">Preview Quiz</li>
                            </ul>
                        </div>
                    <!-- <button class="ribbon-button">
                        <span class="icon">
                            <img loading="lazy" src="{{ url("/images/ribbon_imgs/home-28.png") }}">
                        </span>
                        <span class="caption">Publish</span>
                    </button> -->
                        <span class="title">Preview</span>
                        <div class="group-divider"></div>
                    </div>
                    <div class="group">
                    </div>
                </div>
            </div>
        </nav>

        <div id="edit_hyperlink_modal_container">

            <div class="edit_hyperlink_modal">
                <div id="editor_window_header">
                    <p class="header_title">Edit Hyperlink</p>
                    <span class="edit_hyperlink_close_symbol">&times;</span>
                </div>
                <div id="editor_main_part">
                    <div id='text_bar'>
                        <label for="hyper_text">Text:</label>
                        <input type="text" name="hyper_text" id="hyper_text">
                    </div>
                    <div id="link_to_bar">
                        <label for="">Link to:</label><br>
                        <input type="radio" name="link_type" id="web_page_link" checked value="webpage">
                        <label for="web_page_link">Web page</label><br>
                        <input type="radio" name="link_type" id="email_link" value="email">
                        <label for="email_link">Email</label><br>
                    </div>
                    <div id="add_edit_bar">
                        <label for="address">Address: </label>
                        <input type="text" name="address" id="link_address" value="http://">
                        <div id="hyperlink_test_btn">Test</div>
                        <div id="hyperlink_remove_btn">Remove Link</div>
                    </div>
                    <div id="open_in_new_check">
                        <input type="checkbox" name="open_in_new" id="open_in_new" checked>
                        <label for="open_in_new">Open in a new browser window</label>
                    </div>
                </div>
                <div id="editor_footer_part">
                    <button id="edit_hyperlink_ok">OK</button>
                    <button id="edit_hyperlink_cancel">Cancel</button>
                </div>
            </div>
        </div>

        <div id="recording_panel_holder">
            <span id="close_recording">x</span>
            <iframe id="sound_rec_iframe" src="{{ asset('mic_recording/WebAudioRecorder.js demo.html') }}"
                    title="W3Schools Free Online Web Tutorials">
            </iframe>
        </div>
        <map name="">
            <area shape="" href="" coords="" alt="">
        </map>
        <div class="p-0">

            <div id="content" class="full">
                <div class="post manage_forms">
                    <div class="create_form" id="quiz_form">
                        <div class="content_body">
                            <div class="row">
                                <div class="cell-10" id="quiz_view" style="padding: 0;order: 2;">
                                </div>
                                <div class="cell-10" id="no_question_slide" style="padding: 0;order: 2;display: none;">
                                    <div class="row" style="height: 100%;margin: 0;">
                                        <div class="cell-9"
                                             style="background: #dcdcdc;display: flex;height: 690px;">
                                            <div
                                                style="margin: auto 10px;background: #f1f1f1;width: 100%;padding: 20px;height: 600px;font-size: 18px;display: flex;align-items: center;justify-content: center;">
                                                This question group has no questions. Add new questions.
                                            </div>
                                        </div>
                                        <div class="cell-3 slide_option" style="padding: 0 20px;">
                                            <h3 style="border-bottom: 1px dotted grey;padding: 15px 10px;">Slide
                                                Options</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="cell-2" style="order: 1;border-right: 1px solid #aeaeae;">
                                    <div style="display: flex; justify-content: space-between;">
                                        <div id="form_view_btn" class="view_switch_btn clicked form_view"
                                             style="background-image: url('{{ url('/images/ribbon_imgs/form_view.png') }}');">
                                            Form View
                                        </div>
                                        <div id="slide_view_btn" class="view_switch_btn slide_view"
                                             style="background-image: url('{{ url('/images/ribbon_imgs/slide_show.png') }}');">
                                            Slide View
                                        </div>
                                    </div>
                                    <div class="content_body_main " id="form_view_quiz_list"
                                         style="overflow-y: scroll;height: 650px;">
                                        <ul data-role="listview" data-view="content" id="quiz_list"
                                            data-on-node-click="onNodeClick">
{{--                                            {{ $exam->get_all_questions }}--}}
                                            @foreach ($exam->exam_groups as $exam_group)
                                                @if ($exam_group->group_name != 'Results')
                                                    <li data-caption="{{ $exam_group->group_name }}"
                                                        id="{{ $exam_group->id }}">
                                                        <ul>
                                                            @if (count($exam_group->quizes) == 0)
                                                                <li id="none" data-caption="No questions"
                                                                    data-content="<i>Add questions</i>"></li>
                                                            @else
                                                                @foreach($exam_group->quizes as $quiz)
                                                                    <li class="{{ $quiz->type_id == 13 ? 'instruction_node' : '' }}"
                                                                        id="{{ $quiz->id }}" order="{{ $quiz->order }}"
                                                                        data-caption="{{ strip_tags($quiz->question_element) }}"
                                                                        data-content="<i>{{ $quiz->Quiz_type->name }}</i>"></li>
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                    </li>
                                                @endif
                                            @endforeach
                                            @foreach ($exam->exam_groups as $exam_group)
                                                @if ($exam_group->group_name == 'Results')
                                                    <li data-caption="{{ $exam_group->group_name }}"
                                                        id="{{ $exam_group->id }}">
                                                        <ul>
                                                            @if (count($exam_group->quizes) == 0)
                                                                <li id="none" data-caption="No questions"
                                                                    data-content="<i>Add questions</i>"></li>
                                                            @else
                                                                @foreach($exam_group->quizes as $quiz)
                                                                    <li id="{{ $quiz->id }}" order="{{ $quiz->order }}"
                                                                        data-caption="{{ strip_tags($quiz->question_element) }}"
                                                                        data-content="<i>{{ $quiz->Quiz_type->name }}</i>"></li>
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div id="slide_view_quiz_list"
                                         style="overflow-y: scroll;height: 650px;display: none;">
                                        @foreach ($exam->exam_groups as $exam_group)
                                            @if ($exam_group->group_name != 'Results')
                                                @foreach($exam_group->quizes as $quiz)
                                                    <div id="preview_item-{{ $quiz->id }}" class="preview_item">
                                                        <div
                                                            style="margin: auto;width: {{ $quiz->exam_group->exam->screen_width }}px;height:{{ $quiz->exam_group->exam->screen_height }}px;{{ $quiz->exam_group->exam->theme_style ?? 'background:white' }}"
                                                        >
                                                            <div id="quiz_background_container"
                                                                 style="font-size: 1rem;width: 100%;height:100%;padding: 20px;{{ isset($quiz->background_img) ? ('background-image:' . $quiz->background_img . ';') : '' }}background-size: 100% 100%;background-repeat:no-repeat;">
                                                                {!! $quiz->question_element !!}
                                                                {!! str_replace('slide_view_hotspots_canvas', 'slide_view_hotspots_canvas-' . $quiz->id, $quiz->answer_element) !!}
                                                                @if (isset($quiz->other_elements))
                                                                    {!! $quiz->other_elements !!}
                                                                @endif
                                                                @if (isset($quiz->media))
                                                                    {!! $quiz->media_element !!}
                                                                @else
                                                                    <div
                                                                        class="slide_view_media_element slide_view_group"
                                                                        style="z-index: 1;display: none;position: absolute;top: 0;left: 0;">
                                                                        <img loading="lazy" src="#"
                                                                             alt="slide_view_media"
                                                                             style="width: 100%;height: 100%;">
                                                                    </div>
                                                                @endif
                                                                @if (!isset($quiz->media) && isset($quiz->video))
                                                                    {!! $quiz->video_element !!}
                                                                @else
                                                                    <div
                                                                        class="slide_view_video_element slide_view_group"
                                                                        style="z-index: 1;display: none;position: absolute;top: 0;left: 0;">
                                                                        <video controls
                                                                               style="width: 100%;height: 100%">
                                                                            <source src="#">
                                                                        </video>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endforeach
                                        @foreach ($exam->exam_groups as $exam_group)
                                            @if ($exam_group->group_name == 'Results')
                                                @foreach($exam_group->quizes as $quiz)
                                                    <div id="preview_item-{{ $quiz->id }}" class="preview_item">
                                                        <div
                                                            style="margin: auto;width: {{ $quiz->exam_group->exam->screen_width }}px;height:{{ $quiz->exam_group->exam->screen_height }}px;{{ $quiz->exam_group->exam->theme_style ?? 'background:white' }}"
                                                        >
                                                            <div id="quiz_background_container"
                                                                 style="font-size: 1rem;width: 100%;height:100%;padding: 20px;{{ isset($quiz->background_img) ? ('background-image:' . $quiz->background_img . ';') : '' }}background-size: 100% 100%;background-repeat:no-repeat;">
                                                                {!! $quiz->question_element !!}
                                                                {!! $quiz->answer_element !!}
                                                                @if (isset($quiz->other_elements))
                                                                    {!! $quiz->other_elements !!}
                                                                @endif
                                                                @if (isset($quiz->media))
                                                                    {!! $quiz->media_element !!}
                                                                @else
                                                                    <div
                                                                        class="slide_view_media_element slide_view_group"
                                                                        style="z-index: 1;display: none;position: absolute;top: 0;left: 0;">
                                                                        <img loading="lazy" src="#"
                                                                             alt="slide_view_media"
                                                                             style="width: 100%;height: 100%;">
                                                                    </div>
                                                                @endif
                                                                @if (!isset($quiz->media) && isset($quiz->video))
                                                                    {!! $quiz->video_element !!}
                                                                @else
                                                                    <div
                                                                        class="slide_view_video_element slide_view_group"
                                                                        style="z-index: 1;display: none;position: absolute;top: 0;left: 0;">
                                                                        <video controls
                                                                               style="width: 100%;height: 100%">
                                                                            <source src="#">
                                                                        </video>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.post -->
            </div><!-- /#content -->
        </div>
        <script src="{{ asset('js/quiz_crud.js') }}"></script>
        <script src="{{ asset('js/ribbon_bar.js') }}" defer></script>
        <script src="{{ asset('js/update_quiz.js') }}"></script>
        <script>
            var userSelection = document.getElementsByClassName('quiz_types');
            var ele_num = userSelection.length;

            for (var i = 0; i < ele_num; i++) {
                (function (index) {
                    userSelection[index].addEventListener("mouseleave", function () {
                        $('.tooltip_pic').eq(index).fadeOut();
                    })
                })(i);
            }
            for (var i = 0; i < ele_num; i++) {
                (function (index) {
                    userSelection[index].addEventListener("mouseenter", function () {
                        $('.tooltip_pic').eq(index).fadeIn();
                    })
                })(i);
            }


            $('#form_view_btn').click(function () {

                $('.form_view_element').show();
                $('.slide_view_element').hide();

                $('#form_view_quiz_list').show();
                $('#slide_view_quiz_list').hide();

                if ($(this).hasClass('clicked')) return;
                $(this).toggleClass('clicked');
                $('#slide_view_btn').toggleClass('clicked');

                $('.tabs-holder li').removeClass('active');
                $("#section_home_form").addClass('active');

                $("#section_home_slide").hide();
                $("#section_insert").hide();
                $("#section_design").hide();
                $("#section_home_form").show();

                $('.content-holder .section').removeClass('active');
                $("#section_Home_FormView").addClass('active');

                slide_to_form();

                // if ($('.form_view_element').length > 0) store_quiz_state();
            });


            $('#slide_view_btn').click(function () {
                $('.form_view_element').hide();
                $('.slide_view_element').show();

                $('#form_view_quiz_list').hide();
                $('#slide_view_quiz_list').show();

                if ($(this).hasClass('clicked')) return;
                $(this).toggleClass('clicked');
                $('#form_view_btn').toggleClass('clicked'); //for main branch comment

                $('.tabs-holder li').removeClass('active');
                $("#section_home_slide").addClass('active');

                $("#section_home_form").hide();
                $("#section_home_slide").show();
                $("#section_insert").show();
                $("#section_design").show();

                $('.content-holder .section').removeClass('active');
                $("#section_Home_SlideView").addClass('active');

                form_to_slide();

                localStorage.setItem('is_edited_for_timer', 'true');

                // if ($('.form_view_element').length > 0) store_quiz_state();
            });

            $(document).ready(function () {
                if ($('#form_view_quiz_list .node').length > 0) {
                    $('#form_view_quiz_list .node').eq(0).trigger('click');
                    if ($('#form_view_quiz_list .node').eq(0).attr('data-content') == '<i>Quiz Instructions</i>') $('#introduction_btn').attr('disabled', '');
                }
                for (let i = 1; i < $('#form_view_quiz_list .node-group > div.data').length - 1; i++) {
                    $('#form_view_quiz_list .node-group > div.data').eq(i).append('<i class="fas fa-trash" id="delete_group_icon-' + $('#form_view_quiz_list .node-group').eq(i).attr('id') + '" style="font-size: 12px;" onclick="show_delete_dialog(\'group\', this)"></i>');
                    $('#form_view_quiz_list .node-group > div.data').eq(i).css({
                        'display': 'flex',
                        'align-items': 'center',
                        'justify-content': 'space-around',
                    });
                }

                $('.node-group > .data > .caption').click(function () {
                    console.log('node group');
                });
            });
        </script>
@endsection
