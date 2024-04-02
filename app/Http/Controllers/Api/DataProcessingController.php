<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\Raw;
use App\Models\RawData;
use Illuminate\Support\Carbon;

class DataProcessingController extends BaseController
{
    //refer to data raw file php
    public function processRows()
    {

        // Update the status of the next row that hasn't been processed yet
        Raw::query()->whereNull('status')->orWhere('status', '!=', 'processed')->orderBy('id')->limit(10)->update(['status' => 'under processing']);

        // Fetch the rows that are marked as 'under processing'
        $rows = Raw::query  ()->where('status', 'under processing')->get();

        if ($rows->isNotEmpty()) {
            foreach ($rows as $row) {
                $response = $row->response;
                $data = json_decode($response, true);

                // Process each mention in the response
                foreach ($data['mentions'] as $mention) {
                    $cmeta_json = json_encode($mention['cmeta']); // Encode cmeta as JSON string


                    // Prepare an INSERT ON DUPLICATE KEY UPDATE statement
                    $result = RawData::query()->updateOrInsert(
                        ['id' => $mention['id']],
                        [
                            'commtrack_id' => $mention['commtrack_id']??"",
                            'pub_datetime' => $mention['pub_datetime']? Carbon::parse($mention['pub_datetime'])->format('Y-m-d H:i'):"",
                            'mchannel_id' => $mention['mchannel_id']??"",
                            'uu_id' => $mention['uu_id']??"",
                            'relevance' => $mention['relevance']??"",
                            'profile_country' => $mention['profile_country']??"",
                            'lang_detected' => $mention['lang_detected']??"",
                            'profile_followers_atpost' => $mention['profile_followers_atpost']??"",
                            'mEngagement' => $mention['mEngagement']??"",
                            'cmeta' => $cmeta_json??"",
                            'ftext' => $mention['ftext']??"",
                            'profile_name' => $mention['profile_name']??"",
                            'profile_username' => $mention['profile_username']??"",
                            'screen_name' => $mention['screen_name']??"",
                            'profile_image' => $mention['profile_image']??"",
                            'profile_image_url' => $mention['profile_image_url']??"",
                            'followers_count' => $mention['followers_count']??"",
                            'link' => $mention['link']??"",
                            'thumb_url' => $mention['thumb_url']??"",
                            'likes' => $mention['likes']??"",
                            'comment_count' => $mention['comment_count']??"",
                            'like_count' => $mention['like_count']??"",
                            'views' => $mention['views']??"",
                            'share_count' => $mention['share_count']??"",
                            'retweets' => $mention['retweets']??"",
                            'favorite_count' => $mention['favorite_count']??0,
                            'campaign' => $mention['campaign']??"",
                            'campaign_id' => $mention['campaign_id']??""
                        ]
                    );

                    if ($result) {
                        echo "Data successfully processed for ID {$mention['id']}.\n";
                    } else {
                        echo "Error processing data for ID {$mention['id']}\n";
                    }
                }

                // Mark the processed row in 'raw' table as 'processed'
                Raw::query()->where('id', $row->id)->update(['status' => 'processed']);
            }
            echo "All mentioned rows have been processed.\n";
        } else {
            echo "No rows found or all rows are already processed.\n";
        }
    }
}
