<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Repositories\MixPanelRepository;
use Session;

class MixPanelController extends AdminController
{

    private $oRepository;

    public function __construct(MixPanelRepository $mixpanel)
    {
        parent::__construct();
        $this->oRepository = $mixpanel;
    }

    public function manageChannelSorting()
    {
        return view("admin.events_tracking.mixpanel.manage_channel_sorting.index");
    }

    public function manageChannelSortingListing()
    {
        $aData = array();
        $aGetAllChannels = $this->oRepository->getAllChannels();
        //d($aGetAllChannels['body']['proxy_channels'][0], 1);
        $aData['aAllChannelsData'] = $aGetAllChannels['body']['proxy_channels'];
        return view("admin.events_tracking.mixpanel.manage_channel_sorting.ajax.manage_channel_sorting_listing", $aData);
    }

    public function getSortedChannelsFromMixPanel()
    {
        $aData = array();
        $aGetSortedChannelsIdsFromMixPanel = $this->oRepository->getSortedChannelsFromMixPanel();
        $aData['aSortedChannelsIdsFromMixPanel'] = $aGetSortedChannelsIdsFromMixPanel['body'];
        //d($aGetSortedChannelsIdsFromMixPanel['body'], 1);
        $aGetAllChannels = $this->oRepository->getAllChannels();
        //d($aGetAllChannels['body']['proxy_channels'][0], 1);
        $aData['aAllChannelsData'] = $aGetAllChannels['body']['proxy_channels'];

        return view("admin.events_tracking.mixpanel.manage_channel_sorting.ajax.list_sorted_channels_mixpanel", $aData);
    }

    public function updateSortedChannels()
    {
        //die("success");
        $oResponseData = $this->oRepository->updateSortedChannels();
        if ($oResponseData['header']['code'] == 0 && $oResponseData['header']['code'] == "Success") {
            Session::flash('success', 'Succsessfully Updated!');
        } else {
            Session::flash('danger', 'Somthing went wrong try again!');
        }
        return redirect()->back();
    }

}
