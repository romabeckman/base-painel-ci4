<?php

echo \Config\Services::package()->getScript(['jquery', 'popperjs', 'bootstrap']);

if (isset($scriptTag)) {
    echo \Config\Services::package()->getScript($scriptTag);
}

echo \Config\Services::package()->getScript('painel_main');