<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge">


<link rel="canonical" href="<?php echo current_url(); ?>">
<base href = "<?php echo base_url(); ?>" />

<?php
echo \Config\Services::package()->getStyle(['bootstrap', 'fontawesome', 'painel_main']);

if (isset($linkTag)) {
    echo \Config\Services::package()->getStyle($linkTag);
}