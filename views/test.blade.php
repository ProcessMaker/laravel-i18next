<doctype !html>

<html>
<head>
    <title>Laravel i18next Test</title>
</head>

<body>
<h1>Hello World</h1>
<p id="message">This is a test message</p>

<script src="https://cdnjs.cloudflare.com/ajax/libs/i18next/10.5.0/i18next.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/i18next-xhr-backend/1.5.1/i18nextXHRBackend.min.js"></script>
<script>
i18next
    .use(i18nextXHRBackend)
    .init({
        lng: '{{$lang}}',
        fallbackLng: '{{App::getLocale()}}',
        debug: {{config('app.debug') ? true : false}},
        ns: {!! i18next_namespaces() !!},
        defaultNS: '_default',
        backend: {
            loadPath: '/i18next/fetch/@{{lng}}/@{{ns}}'
        }
}, function(err, t) {
    document.getElementById('message').innerText = i18next.t('i18next:version');
});
</script>
</body>
</html>