<?php
$people = [
    [
        "name" => "Ahmad Hassan",
        "role" => "Developer",
        "skills" => ["PHP", "MySQL", "JavaScript"],
        "image_url" => "images/developer.png"
    ],
    [
        "name" => "Sara Ali",
        "role" => "Designer",
        "skills" => ["Figma", "Photoshop", "UI Design"],
        "image_url" => "images/designer.png"
    ],
    [
        "name" => "Omar Khaled",
        "role" => "Manager",
        "skills" => ["Planning", "Leadership", "Communication"],
        "image_url" => "images/manager.png"
    ],
    [
        "name" => "Lina Nasser",
        "role" => "Analyst",
        "skills" => ["Excel", "SQL", "Data Analysis"],
        "image_url" => "images/analyst.png"
    ],
    [
        "name" => "Yousef Adel",
        "role" => "Tester",
        "skills" => ["Testing", "Selenium", "Bug Reports"],
        "image_url" => "images/tester.png"
    ]
];

function getCardColor($role)
{
    if ($role == "Developer") {
        return "#6c63ff";
    } elseif ($role == "Designer") {
        return "#e0568a";
    } elseif ($role == "Manager") {
        return "#1f9d8a";
    } elseif ($role == "Analyst") {
        return "#e67e22";
    } elseif ($role == "Tester") {
        return "#3498db";
    }

    return "#777777";
}

function renderCard($person)
{
    $color = getCardColor($person["role"]);
    $skills = implode(", ", $person["skills"]);

    return '
    <div class="card">
        <div class="top-line" style="background:' . $color . '"></div>
        <img src="' . $person["image_url"] . '" alt="' . $person["role"] . '">
        <div class="card-content">
            <h3>' . $person["name"] . '</h3>
            <p class="role" style="color:' . $color . '">' . $person["role"] . '</p>
            <p class="skills">' . $skills . '</p>
        </div>
    </div>';
}

$totalPeople = count($people);
$currentDate = date("F j, Y");
$searchQuery = $_GET["search"] ?? "";

if ($searchQuery != "") {
    $people = array_filter($people, function ($person) use ($searchQuery) {
        return stripos($person["name"], $searchQuery) !== false;
    });
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Profile Cards</title>
    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #222;
        }

        header {
            background: #2f4f7f;
            color: white;
            text-align: center;
            padding: 30px 15px;
        }

        header h1 { margin: 0 0 8px; }
        header p { margin: 0; color: #dbe5f2; }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: 30px auto;
        }

        .info {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .info-box {
            width: 220px;
            background: white;
            padding: 18px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,.08);
        }

        .info-box strong {
            display: block;
            font-size: 24px;
            color: #2f4f7f;
        }

        .info-box span {
            color: #666;
            font-size: 14px;
        }

        form {
            text-align: center;
            margin-bottom: 30px;
        }

        form input {
            width: 280px;
            max-width: 70%;
            padding: 11px 14px;
            border: 1px solid #bbb;
            border-radius: 5px;
        }

        form button {
            padding: 11px 20px;
            border: none;
            background: #2f4f7f;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            border-radius: 9px;
            overflow: hidden;
            box-shadow: 0 2px 9px rgba(0,0,0,.08);
        }

        .top-line { height: 6px; }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
            background: #eee;
        }

        .card-content {
            padding: 20px;
            text-align: center;
        }

        .card h3 { margin: 0 0 5px; }
        .role { font-weight: bold; margin: 0 0 12px; }
        .skills { color: #666; font-size: 14px; margin: 0; line-height: 1.6; }

        .empty {
            grid-column: 1 / -1;
            background: white;
            padding: 35px;
            text-align: center;
            border-radius: 8px;
            color: #777;
        }

        footer {
            text-align: center;
            padding: 22px;
            color: #777;
            font-size: 14px;
        }
    </style>
</head>
<body>

<header>
    <h1>Team Profile Cards</h1>
    <p>PHP Arrays, Functions, Loops and Search</p>
</header>

<div class="container">
    <div class="info">
        <div class="info-box">
            <strong><?php echo $totalPeople; ?></strong>
            <span>Total People</span>
        </div>

        <div class="info-box">
            <strong><?php echo $currentDate; ?></strong>
            <span>Current Date</span>
        </div>
    </div>

    <form method="GET">
        <input type="text" name="search" placeholder="Search by name" value="<?php echo htmlspecialchars($searchQuery); ?>">
        <button type="submit">Search</button>
    </form>

    <div class="cards">
        <?php
        if (!empty($people)) {
            foreach ($people as $person) {
                echo renderCard($person);
            }
        } else {
            echo '<div class="empty">No matching person found.</div>';
        }
        ?>
    </div>
</div>

<footer> Adham Muayad Hashem</footer>

</body>
</html>
