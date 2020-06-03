<?php
function app($option) {
    switch ($option) {
        case 'baseUrl':
           require 'config/config.php';
           return $cfg['baseUrl']; 
    }
}