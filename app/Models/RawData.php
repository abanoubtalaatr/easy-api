<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawData extends Model
{
    use HasFactory;
    protected $fillable = [
        'commtrack_id',
        'pub_datetime',
        'mchannel_id',
        'uu_id',
        'relevance',
        'profile_country',
        'lang_detected',
        'profile_followers_atpost',
        'mEngagement',
        'cmeta',
        'ftext',
        'profile_name',
        'profile_username',
        'screen_name',
        'profile_image',
        'profile_image_url',
        'followers_count',
        'link',
        'thumb_url',
        'likes',
        'comment_count',
        'like_count',
        'views',
        'share_count',
        'retweets',
        'favorite_count',
        'campaign',
        'campaign_id'
    ];
}
