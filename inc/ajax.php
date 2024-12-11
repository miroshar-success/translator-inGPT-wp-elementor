<?php
/**
 * Handle AJAX Request for Text Translation
 */
function handle_translate_text()
{
    if (isset($_POST["language"]) && isset($_POST["postId"])) {
        $language = sanitize_text_field($_POST["language"]);
        $postId = intval($_POST["postId"]);
        $containers = "Containers(s)";
        $args = [
            "post_type" => "wine",
            "post_status" => ["publish"],
            "posts_per_page" => 10,
        ];

        //$dataTitle = $Keywords[$language];

        $title = get_the_title($postId) ?: "--";
        $title_title = "Title";
        $long_description =
            get_post_meta($postId, "long_description", true) ?: "--";
        $tasting_notes = get_post_meta($postId, "taste", true) ?: "--";
        $tasting_notes_title = "Tasting Notes";
        $vinification = get_post_meta($postId, "vinification", true) ?: "--";
        $grape_variety = get_post_meta($postId, "grape_variety", true) ?: "--";
        $color = get_post_meta($postId, "color", true) ?: "--";
        $ageing = get_post_meta($postId, "ageing", true) ?: "--";
        $vineyard_soil = get_post_meta($postId, "vineyard_soil", true) ?: "--";

        $product_type = get_post_meta($postId, "product_type", true) ?: "--";
        $white_wine_subtype =
            get_post_meta($postId, "white_wine_subtype", true) ?: "--";
        $sparkling_wine_subtype =
            get_post_meta($postId, "sparkling_wine_subtype", true) ?: "--";
        $fortified_wine_subtype =
            get_post_meta($postId, "fortified_wine_subtype", true) ?: "--";

        $production_year =
            get_post_meta($postId, "production_year", true) ?: "--";
        $list_of_ingredients =
            get_post_meta($postId, "list_of_ingredients", true) ?: "--";
        $country = get_post_meta($postId, "country", true) ?: "--";
        $alcohol_vol = get_post_meta($postId, "alcohol_vol", true) ?: "--";
        $alcohol_vol .= "%";
        $serving_temperature =
            get_post_meta($postId, "serving_temperature", true) ?: "--";

        $total_acidity = get_post_meta($postId, "total_acidity", true) ?: "--";
        $ph = get_post_meta($postId, "ph", true) ?: "--";
        $sugar = get_post_meta($postId, "sugar", true) ?: "--";
        $so2 = get_post_meta($postId, "so2", true) ?: "--";
        $keep = get_post_meta($postId, "keep", true) ?: "--";
        $wine_classification =
            get_post_meta($postId, "wine_classification", true) ?: "--";
        $winemaker = get_post_meta($postId, "winemaker", true) ?: "--";
        $dosage = get_post_meta($postId, "dosage", true) ?: "--";

        $vineyard_type = get_post_meta($postId, "vineyard_type", true) ?: "--";
        $vineyard_climate =
            get_post_meta($postId, "vineyard_climate", true) ?: "--";
        $vineyard_yield =
            get_post_meta($postId, "vineyard_yield", true) ?: "--";
        $vineyard_area = get_post_meta($postId, "vineyard_area", true) ?: "--";
        $vineyard_age = get_post_meta($postId, "vineyard_age", true) ?: "--";

        $emotion_1 = get_post_meta($postId, "emotion_1", true) ?: "--";
        $emotion_2 = get_post_meta($postId, "emotion_2", true) ?: "--";
        $emotion_3 = get_post_meta($postId, "emotion_3", true) ?: "--";

        $region_portugal =
            get_post_meta($postId, "region_portugal", true) ?: "--";
        $region_france = get_post_meta($postId, "region_france", true) ?: "--";
        $region_italy = get_post_meta($postId, "region_italy", true) ?: "--";
        $region_newzealand =
            get_post_meta($postId, "region_newzealand", true) ?: "--";
        $region_switzerland =
            get_post_meta($postId, "region_switzerland", true) ?: "--";
        $other_region = get_post_meta($postId, "other_region", true) ?: "--";
        $list_of_ingredients =
            get_post_meta($postId, "list_of_ingredients", true) ?: "--";
        $harvest = get_post_meta($postId, "harvest", true) ?: "--";

        $bottleData =
            get_post_meta($postId, "packaging_repeater", true) ?: "--";
        $combinedWords = "";

        foreach ($bottleData as $key => $value) {
            foreach ($value as $field => $word) {
                $combinedWords .= $word . "";
            }
            $combinedWords .= "|"; // Corrected
        }
        $combinedWords = trim($combinedWords);

        // Optionally, if you want to add line breaks, you can use:
        //$combinedWordsWithLineBreaks = nl2br($combinedWords);
        $langs = [
            "En" => "English",
            "Es" => "Spanish",
            "Fr" => "French",
            "Uk" => "Ukrainian",
            "Pt" => "Portuguese",
            "It" => "Italian",
            "De" => "German",
            "Nl" => "Dutch",
            "Pl" => "Polish",
            "Ru" => "Russian",
            "Ro" => "Romanian",
            "Dk" => "Danish",
            "No" => "Norwegian",
        ];
        $text =
            "1: $title\n" .
            "2: \"$long_description\"\n" .
            "3: \"$tasting_notes\"\n" .
            "4: \"$product_type\"\n" .
            "5: \"$white_wine_subtype\"\n" .
            "6: \"$sparkling_wine_subtype\"\n" .
            "7: \"$fortified_wine_subtype\"\n" .
            "8: \"$vinification\"\n" .
            "9: \"$production_year\"\n" .
            "10: \"$grape_variety[0]\"\n" .
            "11: \"$country\"\n" .
            "12: \"$color\"\n" .
            "13: \"$alcohol_vol\"\n" .
            "14: \"$region_portugal\"\n" .
            "15: \"$serving_temperature\"\n" .
            "16: \"$ageing\"\n" .
            "17: \"$vineyard_soil\"\n" .
            "18: \"$dosage\"\n" .
            "19: \"$wine_classification\"\n" .
            "20: \"$winemaker\"\n" .
            "21: \"$total_acidity\"\n" .
            "22: \"$ph\"\n" .
            "23: \"$sugar\"\n" .
            "24: \"$so2\"\n" .
            "25: \"$keep\"\n" .
            "26: \"$vineyard_type\"\n" .
            "27: \"$vineyard_climate\"\n" .
            "28: \"$vineyard_yield\"\n" .
            "29: \"$vineyard_area\"\n" .
            "30: \"$vineyard_age\"\n" .
            "31: \"$emotion_1\"\n" .
            "32: \"$emotion_2\"\n" .
            "33: \"$emotion_3\"\n" .
            "34: \"$region_portugal\"\n" .
            "35: \"$region_france\"\n" .
            "36: \"$region_italy\"\n" .
            "37: \"$region_newzealand\"\n" .
            "38: \"$region_switzerland\"\n" .
            "39: \"$other_region\"\n" .
            "40: \"$list_of_ingredients[0]\"\n" .
            "41: \"$harvest\"\n" .
            "42: \"$combinedWords\"\n";

        $api_key =
            "YOUR OPENAI KEY";
        $url = "https://api.openai.com/v1/chat/completions";

        $data = [
            "model" => "gpt-4o-mini",
            "messages" => [
                [
                    "role" => "system",
                    "content" => "You are a helpful assistant.",
                ],
                [
                    "role" => "user",
                    "content" =>
                        $text .
                        "\n\nTranslate this sentence list into " .
                        $langs[ucfirst($language)] .
                        "",
                ],
            ],
            // "max_tokens" => 1000
        ];
        // Prepare the API request
        $response = wp_remote_post($url, [
            "headers" => [
                "Authorization" => "Bearer " . $api_key,
                "Content-Type" => "application/json",
            ],
            "body" => json_encode($data),
            "timeout" => 20,
        ]);

        // Check for errors in the API response
        if (is_wp_error($response)) {
            echo json_encode([
                "error" =>
                    "Translation failed: " . $response->get_error_message(),
            ]);
        } else {
            $body = wp_remote_retrieve_body($response);
            $data = json_decode($body, true);

            if (isset($data["choices"][0]["message"]["content"])) {
                $translation = $data["choices"][0]["message"]["content"];
                $cleaned_translation = str_replace("**", "", $translation);
                $pattern = "/&[^;]+;/";
                $cleaned_translation = preg_replace(
                    $pattern,
                    "-",
                    $cleaned_translation
                );
                $sections = explode("\n", $cleaned_translation);
                $response_data = [];
                foreach ($sections as $section) {
                    $part = explode(":", $section, 2);
                    if (count($part) == 2) {
                        $title = trim($part[0]);
                        $content = str_replace("\"", "", trim($part[1]));
                        if (
                            strpos($title, "Here") !== false ||
                            strpos($title, "Sure") !== false
                        ) {
                            continue;
                        } else {
                            $response_data[] = [
                                "title" => $title,
                                "content" => $content,
                            ];
                        }
                    }
                }

                echo json_encode(["data" => $response_data]);
            } else {
                echo json_encode([
                    "error" =>
                        "Translation failed: Unexpected response format.",
                ]);
            }
        }
    } else {
        echo json_encode(["error" => "Invalid input."]);
    }

    wp_die();
}
add_action("wp_ajax_translate_text", "handle_translate_text");
add_action("wp_ajax_nopriv_translate_text", "handle_translate_text");
