<?php

echo \Config\Services::package()->getScript(['jquery', 'popperjs', 'bootstrap']);
echo \Config\Services::package()->getScript('painel_main');

if (isset($scriptTag)) {
    echo \Config\Services::package()->getScript($scriptTag);
}
