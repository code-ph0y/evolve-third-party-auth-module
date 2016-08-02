<?php $view->extend('::base.html.php'); ?>

<?php $view['slots']->start('include_css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $view['assets']->getUrl('modules/thirdpartyauth/css/bootstrap-social.css'); ?>" />
<?php $view['slots']->stop(); ?>

<div class="row">
    <div class="col-md-4 col-md-offset-3">
        <a class="btn btn-block btn-social btn-facebook" href="<?php echo $view['router']->generate('ThirdPartyAuthModule_Facebook_Authenticate'); ?>">
          <span class="fa fa-facebook"></span> Sign in with Facebook
        </a>

        <a class="btn btn-block btn-social btn-twitter">
          <span class="fa fa-twitter"></span> Sign in with Twitter
        </a>

        <a class="btn btn-block btn-social btn-google">
          <span class="fa fa-google"></span> Sign in with Google
        </a>
    </div>
</div>
