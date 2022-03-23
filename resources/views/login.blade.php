<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Atte</title>
</head>

<body>
  <div id="wrap">
    <header id="header">
      <div class="inner">
        <p class="logo">Atte</p>
      </div>
    </header>

    <main>
      <article class="card_form">
        <p class="login_top">ログイン</p>
        <section class="form">
          <form method="POST">
            @csrf
            <div class="form_md">
              <input class="form_input" type="text" id="email" name="email" required value="{{ old('email') }}" placeholder="メールアドレス">
            </div>

            <div class="form_md">
              <input class="form_input" type="text" id="password" name="password" required value="{{ old('password') }}" placeholder="パスワード">
            </div>

            <div class="form_md">
              <button class="login_btn" type="submit">ログイン</button>
            </div>
          </form>
        </section>

        <section class="register">
          <p class="register_txt">アカウントをお持ちでない方はこちらから</p>
          <a href="/register" class="register_link">会員登録</a>
        </section>
      </article>
    </main>

    <footer>
      Atte, inc.
    </footer>
  </div>
</body>

</html>