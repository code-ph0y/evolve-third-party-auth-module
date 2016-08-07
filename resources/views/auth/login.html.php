<?php $view->extend('::base.html.php'); ?>

<?php $view['slots']->start('include_css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $view['assets']->getUrl('modules/thirdpartyauth/css/bootstrap-social.css'); ?>" />
<?php $view['slots']->stop(); ?>

<div class="row">
    <div class="col-md-4 col-md-offset-3">
        <h1>Login With</h1>
        <hr />
        <?php if(!empty($activeThirdParties)) : ?>
            <?php foreach ($activeThirdParties as $service) : ?>
                <a class="btn btn-block btn-social btn-<?php echo $service; ?>" href="<?php echo $view['router']->generate('ThirdPartyAuthModule_Authorise', array('service' => $service)); ?>">
                  <span class="fa fa-<?php echo $service; ?>"></span> Sign in with <?php echo ucfirst($service); ?>
                </a>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="alert alert-info">
                No Third Parties have been setup
            </div>
        <?php endif; ?>
    </div>
</div>
