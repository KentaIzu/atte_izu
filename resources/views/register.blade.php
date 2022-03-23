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
        <p class="register_top">会員登録</p>
        <section class="form">
          <form method="POST">
            @csrf
            <div class="form_md">
              <input class="form_input" type="text" id="name" name="name" required value="{{ old('name') }}" placeholder="名前">
            </div>

            <div class="form_md">
              <input class="form_input" type="text" id="email" name="email" required value="{{ old('email') }}" placeholder="メールアドレス">
            </div>

            <div class="form_md">
              <input class="form_input" type="text" id="password" name="password" required value="{{ old('password') }}" placeholder="パスワード">
            </div>

            <div class="check_form">
              <input class="form_input" type="text" id="password" name="password" required value="{{ old('password') }}" placeholder="確認用パスワード">
            </div>

            <div class="register">
              <button class="register_btn" type="submit">会員登録</button>
            </div>
          </form>
        </section>

        <section class="login_btn">
          <p class="login_txt">アカウントをお持ちの方はこちらから</p>
          <a href="/login" class="login_link">ログイン</a>
        </section>
      </article>
    </main>

    <footer>
      Atte, inc.
    </footer>
  </div>
</body>

</html>