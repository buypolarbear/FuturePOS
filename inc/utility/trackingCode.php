<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//<?php echo $endpointSitePiwik; ?>";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', <?php echo $idSitePiwik; ?>]);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<noscript><p><img src="//<?php echo $endpointSitePiwik; ?>piwik.php?idsite=<?php echo $idSitePiwik; ?>" style="border:0;" alt="" /></p></noscript>
<!-- End Piwik Code -->
