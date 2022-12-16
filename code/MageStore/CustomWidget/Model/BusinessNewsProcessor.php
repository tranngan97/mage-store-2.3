<?php
/**
 * Copyright © Nim248. All rights reserved.
 */
namespace MageStore\CustomWidget\Model;

/**
 * Get News .
 */
class BusinessNewsProcessor implements \MageStore\CustomWidget\Api\BusinessNewsInterface
{
    public function getNewsList()
    {
        $ctx = stream_context_create(['ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false
        ]]);
        $xmlContent = file_get_contents(
            'https://vnexpress.net/rss/kinh-doanh.rss',
            false,
            $ctx
        );
        $content = json_encode(simplexml_load_string($xmlContent));
        $xmlArray = json_decode($content, true);
        return $xmlArray['channel']['item'];
    }
}
