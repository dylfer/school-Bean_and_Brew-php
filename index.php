<?php
  include 'components/session.php';
  include 'components/DB_close.php';
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>

    <link href="stlye.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body>
    <?php
      include 'components/nav.php';
      ?>
      <div class="text-2xl flex flex-col items-center justify-center w-screen h-screen">
        <h1 class="text-center">Welcome to Bean and Brew</h1>
        <p class="text-center">The best coffee shop in town</p>
    </div>
      <?php
      include 'components/footer.php';
      ?>
    <script src="script.js"></script>
  </body>
</html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Learn more about Ableton - maker of Live and Push | Ableton</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="w-screen flex justify-center items-center bg-gray-100">
    <div class="max-w-[100rem] flex justify-center flex-col bg-white">
      <div class="nav w-full text-xl text-black">
        <div class="flex w-full m-5">
          <div class="nav-logo">
            <svg
              role="img"
              aria-label="Logo Ableton"
              class="main-nav__logo__image"
              xmlns="http://www.w3.org/2000/svg"
              width="60"
              height="28"
              viewBox="0 0 45 21"
            >
              <path
                d="M0 0h3v21H0zM6 0h3v21H6zM12 0h3v21h-3zM18 0h3v21h-3zM24 18h21v3H24zM24 12h21v3H24zM24 6h21v3H24zM24 0h21v3H24z"
              ></path>
            </svg>
          </div>
          <div class="nav-start inline">
            <a class="p-2" href="#">Live</a>
            <a class="p-2" href="#">Push</a>
            <a class="p-2" href="#">Note</a>
            <a class="p-2" href="#">Link</a>
            <a class="p-2" href="#">Shop</a>
            <a class="p-2" href="#">Packs</a>
            <a class="p-2" href="#">Help</a>
            <a class="p-2" href="#">More +</a>
          </div>
          <div class="nav-trailing inline">
            <a class="text-blue-700" href="/login">login</a>
            <a class="" href="/register">sign up</a>
          </div>
        </div>
        <div class="break h-0.5 w-full bg-gray-100"></div>
        <div class="sub-nav m-4">
          <a class="p-3 text-orange-600" href="#">About</a>
          <a class="p-3" href="#">Jobs</a>
          <a class="p-3" href="#">Apprenterships</a>
        </div>
      </div>

      <div class="w-full flex items-center justify-center mt-2">
        <img
          class="hero-image"
          src="https://ableton-production.imgix.net/about/header.jpg?auto=format&fit=crop&fm=jpg&h=1185&ixjsv=1.1.3&w=1333"
          alt="hero image"
        />
        <svg
          class="absolute z-20"
          with="430px"
          height="104px"
          viewBox="0 0 430 104"
        >
          <title>Ableton</title>
          <g fill="#FD5948">
            <path
              d="M32.6204615,65.1749841 L47.5563462,31.7794286 L62.5038077,65.1749841 L32.6204615,65.1749841 L32.6204615,65.1749841 Z M93.8623846,100.13219 C86.5871154,84.2631111 78.9777692,67.7271111 71.3717308,51.1878095 C63.7656923,34.6567619 56.1629615,18.1306667 48.8810769,2.24342857 C48.6313462,1.7944127 48.1550385,1.51873016 47.6076154,1.51873016 C47.0535769,1.51873016 46.5326154,1.80101587 46.2134231,2.27644444 L1.24534615,100.156952 C1.08823077,100.634032 1.13619231,101.121016 1.38923077,101.467683 C1.63565385,101.807746 2.05407692,101.994286 2.57007692,101.994286 L15.2071154,101.994286 C15.6916923,101.994286 16.1431923,101.688889 16.5467308,101.073143 L26.9097308,78.3235556 L68.2145385,78.3235556 L68.2806923,78.4688254 C69.7145769,81.6614603 71.2427308,84.9779048 72.7245769,88.1870476 C74.7009231,92.4791111 76.7483846,96.9147937 78.5924231,101.10946 C78.9777692,101.695492 79.4176923,101.994286 79.9155,101.994286 L92.5459231,101.994286 C93.0635769,101.994286 93.4853077,101.807746 93.7300769,101.467683 C93.9831154,101.116063 94.0310769,100.629079 93.8623846,100.13219 Z M131.990154,91.6751746 C121.000346,91.6751746 115.246615,81.7786667 115.246615,72.0043175 C115.246615,62.6525714 121.117769,52.7147937 131.990154,52.7147937 C142.230769,52.7147937 149.382,60.6468571 149.382,72.0043175 C149.382,81.7968254 144.002038,91.6751746 131.990154,91.6751746 Z M134.6975,40.3420952 C127.597538,40.3420952 121.455154,43.0840635 116.445654,48.4970159 L116.020615,48.9559365 L116.020615,2.52571429 C116.020615,2.01066667 115.349154,1.35860317 114.595,1.35860317 L103.375308,1.35860317 C102.616192,1.35860317 101.941423,2.01066667 101.941423,2.52571429 L101.941423,100.698413 C101.941423,101.428063 102.573192,101.994286 103.375308,101.994286 L114.461038,101.994286 C115.264808,101.994286 115.891615,101.428063 115.891615,100.698413 L115.891615,95.463746 L116.315,95.896254 C121.284808,101.000508 127.802615,103.924063 134.186462,103.924063 C154.034269,103.924063 163.070885,87.247746 163.070885,71.7484444 C163.070885,56.5215238 153.127962,40.3420952 134.6975,40.3420952 Z M184.660192,1.35860317 L173.574462,1.35860317 C172.815346,1.35860317 172.142231,2.01066667 172.142231,2.52571429 L172.142231,100.698413 C172.142231,101.428063 172.770692,101.994286 173.574462,101.994286 L184.660192,101.994286 C185.287,101.994286 185.958462,101.475937 185.958462,100.698413 L185.958462,2.52571429 C185.958462,2.03542857 185.305192,1.35860317 184.660192,1.35860317 Z M210.465154,65.1749841 L210.554462,64.8629841 C212.320769,58.6989206 217.836346,52.4589206 224.966077,52.4589206 C232.990538,52.4589206 237.609731,58.8673016 239.255308,64.8629841 L239.338,65.1749841 L210.465154,65.1749841 Z M224.966077,40.3420952 C206.912692,40.3420952 195.702923,52.6702222 195.702923,72.5210159 C195.702923,91.0099048 207.843808,103.924063 225.230692,103.924063 C236.9945,103.924063 246.973808,97.9250794 252.600192,87.4606984 L252.694462,87.2791111 C252.754,86.8631111 252.492692,86.4421587 251.887385,85.9617778 L242.510077,80.7106032 C241.805538,80.3078095 241.266385,80.3936508 240.761962,81.0308571 C237.024269,87.0546032 233.503231,91.6751746 225.354731,91.6751746 C216.546346,91.6751746 210.179038,85.7950476 209.515846,77.0408889 L209.494346,76.7784127 L252.041192,76.7784127 C252.730846,76.7784127 253.471769,76.4119365 253.471769,75.6063492 L253.471769,73.8102857 C253.471769,58.3704127 246.009615,40.3420952 224.966077,40.3420952 Z M297.834538,42.1398095 L284.053038,42.1398095 L284.053038,26.4539683 C284.053038,25.7325714 283.555231,25.2868571 282.7465,25.2868571 L271.665731,25.2868571 C270.954577,25.2868571 270.235154,25.6450794 270.235154,26.4539683 L270.235154,33.0208254 C270.235154,35.9790476 270.235154,42.1398095 261.997346,42.1398095 L259.677,42.1398095 C258.917885,42.1398095 258.243115,42.7951746 258.243115,43.3151746 L258.243115,53.7366349 C258.243115,54.7023492 259.339615,54.7749841 259.677,54.7749841 L270.235154,54.7749841 L270.235154,80.0651429 C270.235154,96.3188571 276.301462,103.884444 289.327154,103.884444 C293.114462,103.884444 296.132731,103.427175 298.304231,102.519238 L298.297615,102.469714 C298.816923,102.369016 299.261808,101.707048 299.261808,101.424762 L299.261808,90.4915556 C299.261808,89.8543492 298.608538,89.3161905 297.834538,89.3161905 C297.555038,89.3161905 297.062192,89.487873 296.891846,89.5572063 C295.315731,90.1828571 293.688346,90.8349206 291.351462,90.8349206 C290.818923,90.8349206 290.258269,90.8019048 289.682731,90.7325714 C283.998462,89.4697143 284.031538,82.0097778 284.053038,77.0755556 L284.053038,54.7749841 L297.834538,54.7749841 C298.168615,54.7749841 299.261808,54.7023492 299.261808,53.7366349 L299.261808,43.3151746 C299.261808,42.7951746 298.588692,42.1398095 297.834538,42.1398095 Z M337.118346,90.9092063 C327.102654,90.9092063 318.954154,82.4819048 318.954154,72.1297778 C318.954154,61.8552381 327.102654,53.4906667 337.118346,53.4906667 C347.272962,53.4906667 355.538885,61.8552381 355.538885,72.1297778 C355.538885,82.4819048 347.272962,90.9092063 337.118346,90.9092063 Z M337.118346,40.3420952 C319.112923,40.3420952 305.010577,54.3028571 305.010577,72.1297778 C305.010577,89.9583492 319.112923,103.924063 337.118346,103.924063 C355.123769,103.924063 369.227769,89.9583492 369.227769,72.1297778 C369.227769,54.3028571 355.123769,40.3420952 337.118346,40.3420952 Z M407.623462,40.3420952 C401.669615,40.3420952 395.856346,42.6697143 392.075654,46.5721905 L391.680385,46.9815873 L391.529885,43.3168254 C391.529885,42.791873 390.855115,42.1398095 390.092692,42.1398095 L379.008615,42.1398095 C378.2495,42.1398095 377.578038,42.791873 377.578038,43.3069206 L377.578038,100.698413 C377.578038,101.428063 378.2065,101.994286 379.008615,101.994286 L390.092692,101.994286 C390.898115,101.994286 391.529885,101.428063 391.529885,100.698413 L391.529885,74.4507937 C391.529885,64.7688889 391.529885,52.7180952 404.272769,52.7180952 C414.749885,52.7180952 415.603269,59.5886984 415.603269,67.8905397 L415.603269,100.698413 C415.603269,101.428063 416.231731,101.994286 417.032192,101.994286 L428.121231,101.994286 C428.888615,101.994286 429.422808,101.464381 429.422808,100.698413 L429.422808,66.4708571 C429.422808,48.399619 422.699923,40.3420952 407.623462,40.3420952 Z"
              id="Fill-9"
              sketch:type="MSShapeGroup"
            ></path>
          </g>
        </svg>
      </div>
      <div class="main w-full">
        <div class="text section w-full">
          <div class="text-wraper">
            <h1>
              We make <a href="#">Live</a>, <a href="#">Push</a> and
              <a href="#">Link</a> — unique software and hardware for music
              creation and performance. With these products, our community of
              users creates amazing things.
            </h1>
            <div class="break"></div>
            <p>
              Ableton was founded in 1999 and released the first version of Live
              in 2001. Our products are used by a community of dedicated
              musicians, sound designers, and artists from across the world.
            </p>
          </div>
        </div>

        <div class="images section w-full"></div>

        <div class="text section w-full">
          <div class="text-wraper">
            <h1>
              Making music isn’t easy. It takes time, effort, and learning. But
              when you’re in the flow, it’s incredibly rewarding.
            </h1>
            <div class="break"></div>
            <p>
              We feel the same way about making Ableton products. The driving
              force behind Ableton is our passion for what we make, and the
              people we make it for.
            </p>
          </div>
        </div>

        <div class="video section w-full"></div>

        <div class="text section w-full">
          <div class="text-wraper">
            <h1>
              We are more than 350 people from 30 different countries divided
              between our headquarters in Berlin and our offices in Los Angeles
              and Tokyo.
            </h1>
            <div class="break"></div>
            <p>
              Most of us are active musicians, producers, and DJs, and many of
              us use Live and Push every day. We come from a wide range of
              cultural and professional backgrounds. Some of us have PhDs, some
              are self-taught, and most of us are somewhere in between. What
              connects us is the shared belief that each of us has the skills
              and knowledge to contribute to something big: helping to shape the
              future of music culture.
            </p>
          </div>
        </div>

        <div class="images section w-full"></div>

        <div class="text section w-full">
          <div class="text-wraper">
            <h1>
              We believe it takes focus to create truly outstanding instruments.
              We only work on a few products and we strive to make them great.
            </h1>
            <div class="break"></div>
            <p>
              Rather than having a one-size-fits-all process, we try to give our
              people what they need to work their magic and grow. We’ve learned
              that achieving the best results comes from building teams that are
              richly diverse, and thus able to explore problems from a wider set
              of perspectives. We don’t always agree with each other, but
              opinion and debate are valued and openly encouraged.
            </p>
          </div>
        </div>

        <div class="video section w-full"></div>

        <div class="text section w-full">
          <div class="text-wraper">
            <h1>
              We’re passionate about what we do, but we’re equally passionate
              about improving who we are.
            </h1>
            <div class="break"></div>
            <p>
              We work hard to foster an environment where people can grow both
              personally and professionally, and we strive to create a wealth of
              opportunities to learn from and with each other.<br /><br />Alongside
              an internal training program, employees are actively supported in
              acquiring new knowledge and skills, and coached on applying these
              in their daily work. In addition, staff-organized development and
              music salons are a chance to discuss new technologies, production
              techniques and best practices.
            </p>
          </div>
        </div>

        <div class="images section w-full"></div>

        <div class="text section w-full">
          <div class="text-wraper">
            <h1>
              We want our employees to love it here. Since we’re looking for
              exceptional talent from around the world, we will do everything we
              can to make your transition as easy as possible.
            </h1>
            <div class="break"></div>
            <p>
              If you're joining us in Berlin, we'll help with relocation and
              paperwork. We’ll even provide you with free German or English
              lessons. Plus, working in Germany means you can expect
              comprehensive health insurance for you and your family, as well as
              generous maternity and paternity leave. Office hours are flexible,
              but it’s not all work; we have several company and team outings
              throughout the year as well as a variety of fun, informal
              small-group activities.
            </p>
          </div>
        </div>

        <div class="images section w-full"></div>
      </div>
      <footer></footer>
    </div>
  </body>
</html>

