<?php
namespace BIKompass\Controller;

class FloorplanController
{
    private $floorplan_svg = '';
    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = app('baseUrl') . '/svg/';     
    }

    /* id z.B. nw10og1 */
    public function getFloor($floorId)
    {
        return $this->floorplan_svg = file_get_contents(sprintf($this->baseUrl . '%s.svg', $floorId));
        
    }

}