<?php require_once('php/_lof.php'); ?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title><?php EchoTitle(false); ?></title>
<meta name="description" content="<?php EchoMetaDescription(false); ?>">
<link href="../../common/style.css" rel="stylesheet" type="text/css" />
</head>

<body bgproperties=fixed leftmargin=0 topmargin=0>
<?php _LayoutLofTopLeft(false); ?>

<div>
<h1><?php EchoTitle(false); ?></h1>
<p><b>Please notice that using <?php EchoEtfSymbol(); ?> to estimate this LOF is not accurate.</b></p>
<?php EchoAll(false); ?>
<p>Related software:
<?php
    EchoBricSoftwareLinks(false);
    EchoASharesSoftwareLinks(false);
    EchoHSharesSoftwareLinks(false);
    EchoHangSengSoftwareLinks(false);
    EchoSpySoftwareLinks(false);
    EchoQqqSoftwareLinks(false);
    EchoCiticPruSoftwareLinks(false);
    EchoStockGroupLinks(false);
?>
</p>
</div>

<?php LayoutTailLogin(false); ?>

</body>
</html>