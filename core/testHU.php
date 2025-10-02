<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Demo Hiệu Ứng CSS</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background: #f0f0f0;
        padding: 40px;
        display: flex;
        flex-direction: column;
        gap: 40px;
        align-items: center;
    }

    /* 1. Hiệu ứng hover */
    .hover-btn {
        padding: 12px 25px;
        background: #3498db;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
    }

    .hover-btn:hover {
        background: orange;
        color: black;
    }

    /* 2. Transition */
    .transition-box {
        width: 100px;
        height: 100px;
        background: #9b59b6;
        transition: all 0.5s ease;
    }

    .transition-box:hover {
        width: 150px;
        background: #e67e22;
    }

    /* 3. Transform */
    .transform-box {
        width: 100px;
        height: 100px;
        background: #2ecc71;
        transition: transform 0.4s;
    }

    .transform-box:hover {
        transform: scale(1.3) rotate(20deg);
    }

    /* 4. Animation */
    @keyframes move {
        0% {
            left: 0;
            background: red;
        }

        50% {
            left: 150px;
            background: yellow;
        }

        100% {
            left: 0;
            background: red;
        }
    }

    .animate-ball {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        position: relative;
        background: red;
        animation: move 3s infinite;
    }

    /* 5. Shadow */
    .shadow-box {
        width: 200px;
        padding: 20px;
        background: white;
        box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);
        text-align: center;
        text-shadow: 1px 1px 5px gray;
        border-radius: 8px;
    }

    /* 6. Filter */
    .filter-img {
        width: 200px;
        transition: filter 0.4s;
    }

    .filter-img:hover {
        filter: grayscale(100%) brightness(1.2);
    }

    /* 7. Cursor */
    .cursor-demo {
        padding: 10px 20px;
        border: 2px dashed #333;
        cursor: pointer;
    }
    </style>
</head>

<body>

    <button class="hover-btn">Hover vào tôi</button>

    <div class="transition-box"></div>

    <div class="transform-box"></div>

    <div class="animate-ball"></div>

    <div class="shadow-box">Hiệu ứng bóng</div>

    <img src="https://picsum.photos/200" alt="demo" class="filter-img">

    <div class="cursor-demo">Đưa chuột vào đây</div>

</body>

</html>