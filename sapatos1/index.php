<?php include "db.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>SHOES INVENTORY SYSTEM</title>
<style>
/* ================= BASE ================= */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    background-color: #121212;
    color: #f0f0f0;
    min-height: 100vh;
    line-height: 1.5;
}

.container {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 1rem;
}

/* ================= HEADER ================= */
h1 {
    text-align: center;
    margin-bottom: 2rem;
    font-size: 2.5rem;
    color: #ffd700;
    text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
}

/* ================= FORM ================= */


.add-shoe-form {
    background-color: #1e1e1e;
    padding: 1.5rem;
    border-radius: 10px;
    margin-bottom: 2rem;
    box-shadow: 0 0 15px rgba(0,0,0,0.5);
}

.add-shoe-form h3 {
    margin-top: 1rem;
    margin-bottom: 0.5rem;
    color: #ffa500;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 0.8rem;
    margin-bottom: 1rem;
}

.form-grid label {
    font-size: 0.8rem;
    margin-bottom: 0.2rem;
    color: #aaa;
}

.add-shoe-form input[type="text"],
.add-shoe-form input[type="number"],
.add-shoe-form input[type="file"],
.add-shoe-form select {
    padding: 0.5rem;
    border-radius: 6px;
    border: none;
    background-color: #2a2a2a;
    color: #f0f0f0;
    width: 100%;
}

.add-shoe-form button {
    padding: 0.6rem 1.2rem;
    border: none;
    border-radius: 8px;
    background-color: #ff9800;
    color: #121212;
    cursor: pointer;
    font-weight: bold;
    transition: 0.2s;
    margin-top: 0.5rem;
}

.add-shoe-form button:hover {
    background-color: #ffc107;
}


/* ================= INVENTORY GRID ================= */
.inventory-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    justify-content: center;
}

@media (max-width: 1200px) { .inventory-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 900px) { .inventory-grid { grid-template-columns: repeat(1, 1fr); } }
@media (max-width: 600px) { .inventory-grid { grid-template-columns: repeat(1, 1fr); } }

/* ================= SHOE CARD ================= */
.shoe-item {
    background-color: #1e1e1e;
    border-radius: 12px;
    padding: 0.8rem;
    box-shadow: 0 0 10px rgba(0,0,0,0.4);
    display: flex;
    flex-direction: column;
}

.shoe-item:hover { box-shadow: 0 0 15px rgba(255,215,0,0.6); }

/* ================= SHOE IMAGE ================= */
.shoe-image {
    width: 100%;
    height: 120px;
    object-fit: contain;
    margin-bottom: 0.5rem;
    border-radius: 8px;
    background-color: #2a2a2a;
}

/* ================= SHOE INFO ================= */
.shoe-info h3 {
    color: #ffa500;
    font-size: 1rem;
    margin-bottom: 0.2rem;
    text-align: center;
}

.shoe-info small {
    display: block;
    color: #bbb;
    font-size: 0.7rem;
    text-align: center;
}

/* ================= SIZES ================= */
.sizes-container {
    margin-top: 0.8rem;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.size-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

/* Form inside size-item */
.size-item form {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

/* Labels with inputs */
.size-item form label {
    display: flex;
    flex-direction: column;
    font-size: 0.7rem;
    color: #aaa;
    min-width: 70px;
}

.size-item form label input {
    margin-top: 0.1rem;
    width: 60px;
    padding: 0.2rem 0.4rem;
    border-radius: 6px;
    border: none;
    background-color: #2a2a2a;
    color: #f0f0f0;
    text-align: center;
}

/* Update button */
.update-btn {
    padding: 0.25rem 0.6rem;
    border: none;
    border-radius: 5px;
    background-color: #2196f3;
    color: #fff;
    cursor: pointer;
    font-weight: bold;
    font-size: 0.7rem;
    transition: 0.2s;
    align-self: flex-end;
}

.update-btn:hover {
    background-color: #42a5f5;
}

/* Delete button for size row */
.delete-size-btn {
    background-color: #f44336;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 0.25rem 0.6rem;
    cursor: pointer;
    font-weight: bold;
    font-size: 0.7rem;
    transition: 0.2s;
    margin-top: 20px;
}

.delete-size-btn:hover {
    background-color: #e57373;
}

/* Add size button */
.add-size-btn {
    background-color: #4caf50;
    color: #fff;
    padding: 0.25rem 0.5rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    font-size: 0.7rem;
    transition: 0.2s;
}

.add-size-btn:hover {
    background-color: #66bb6a;
}

/* Delete shoe button */
.delete-btn {
    background-color: #f44336;
    color: #fff;
    padding: 0.25rem 0.5rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    font-size: 0.7rem;
    transition: 0.2s;
    margin-top: 30px;
}

.delete-btn:hover {
    background-color: #e57373;
}

/* New size input box */
.new-size-box {
    display: flex;
    align-items: center;
    gap: 0.3rem;
    margin-top: 0.3rem;
}

.new-size-box input {
    width: 65px;
    padding: 0.2rem 0.3rem;
    margin-top: 10px;
 
}

.new-size-box select{
    margin-top: 0.1rem;
    padding: 0.2rem 0.4rem;
    border: none;
    text-align: left;
}

.size-item form label select {
    margin-top: 0.1rem;
    padding: 0.2rem 0.4rem;
    border-radius: 6px;
    border: none;
    background-color: #2a2a2a;
    color: #f0f0f0;
    text-align: left;
}

/* ================= CUSTOM POPUP ================= */
.popup-overlay {
    position: fixed;
    top:0; left:0;
    width:100%; height:100%;
    background-color: rgba(0,0,0,0.7);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.popup-box {
    background-color: #1e1e1e;
    padding: 2rem;
    border-radius: 12px;
    max-width: 400px;
    width: 90%;
    text-align: center;
    color: #fff;
    box-shadow: 0 0 20px rgba(255,215,0,0.5);
}

.popup-box h3 {
    margin-bottom: 1rem;
}

.popup-box button {
    padding: 0.5rem 1rem;
    margin: 0.3rem;
    border:none;
    border-radius:6px;
    cursor:pointer;
    font-weight:bold;
    font-size:0.8rem;
}

.popup-confirm { background-color: #f44336; color:#fff; }
.popup-cancel { background-color: #2196f3; color:#fff; }
.popup-confirm:hover { background-color:#e57373; }
.popup-cancel:hover { background-color:#42a5f5; }

</style>
</head>
<body>

<div class="container">
<h1>ALEX'S SHOES INVENTORY SYSTEM</h1>

<!-- ADD NEW SHOE FORM -->
<div class="add-shoe-form">
<form method="POST" action="add_shoe.php" enctype="multipart/form-data">
    <div class="form-grid">
        <div><label>Brand</label><input type="text" name="brand" placeholder="Brand" required/></div>
        <div><label>Model</label><input type="text" name="model" placeholder="Model" required/></div>
        <div><label>Item ID</label><input type="text" name="item_id" placeholder="Item ID" required/></div>
        <div><label>Image</label><input type="file" name="image" required/></div>
    </div>
    <h3>Add Sizes</h3>
    <div id="sizesContainer">
        <div class="form-grid">
            <div><label>Size</label><input type="number" name="size[]" placeholder="Size" required/></div>
            <div><label>Price</label><input type="number" name="size" step="0.5" min="1" max="20" placeholder="Size" required/></div>
            <div><label>Stock(s)</label><input type="number" name="stock[]" placeholder="Stock" required/></div>
            <div>
                <label>Variation</label>
                <select name="variation[]" required>
                    <option value="" disabled selected>Select...</option>
                    <option value="Mens">US MENS</option>
                    <option value="Womens">US WOMENS</option>
                </select>
            </div>
        </div>
    </div>
    <button type="button" onclick="addSize()">+ Add Another Size</button>
    <button type="submit">Add Shoe</button>
</form>
</div>

<!-- INVENTORY -->
<div class="inventory-grid">
<?php
$shoes = $conn->query("SELECT * FROM shoes ORDER BY created_at DESC");
while($shoe = $shoes->fetch_assoc()):
    $sizes_res = $conn->query("SELECT * FROM shoe_sizes WHERE shoe_id=".$shoe['id']." ORDER BY size ASC");
?>
<div class="shoe-item">
    <?php if($shoe['image']): ?>
        <img src="data:<?= $shoe['image_type'] ?>;base64,<?= base64_encode($shoe['image']) ?>" class="shoe-image"/>
    <?php endif; ?>
    <div class="shoe-info">
        <h3><?= htmlspecialchars($shoe['model']) ?></h3>
        <small>Brand: <?= htmlspecialchars($shoe['brand']) ?></small>
        <small>ID: <?= htmlspecialchars($shoe['item_id']) ?></small>
        <small>Inserted: <?= $shoe['created_at'] ?></small>

        <div class="sizes-container">
        <?php while($size = $sizes_res->fetch_assoc()):
            $variation = htmlspecialchars($size['variation'] ?? '');
            $badgeClass = 'variation-other';
            $v = strtolower($variation);
            if($v === 'mens') $badgeClass = 'variation-mens';
            elseif($v === 'womens') $badgeClass = 'variation-womens';
            elseif($v === 'unisex') $badgeClass = 'variation-unisex';
            elseif($v === 'kids') $badgeClass = 'variation-kids';
        ?>
            <div class="size-item">
                <form method="POST" action="update_size_full.php">
                    <input type="hidden" name="id" value="<?= $size['id'] ?>" />
                    <label>Size
                        <input type="number" name="size" step="0.5" min="1" max="20" value="<?= $size['size'] ?>" required />
                    </label>
                    <label>Price
                        <input type="number" name="price" value="<?= $size['price'] ?>" required />
                    </label>
                    <label>Stock(s)
                        <input type="number" name="stock" value="<?= $size['stock'] ?>" required />
                    </label>
                    <label>Variation
                        <select name="variation" required>
                            <option value="Mens" <?= ($variation === 'Mens') ? 'selected' : '' ?>>US MENS</option>
                            <option value="Womens" <?= ($variation === 'Womens') ? 'selected' : '' ?>>US WOMENS</option>
                        </select>
                    </label>
                    <button type="submit" class="update-btn">Update</button>
                </form>
                <button class="delete-size-btn" onclick="showPopup('deleteSize', <?= $size['id'] ?>)">X</button>
            </div>
        <?php endwhile; ?>
        </div>

        <div class="new-size-box">
            <form method="POST" action="add_size_existing.php">
                <input type="hidden" name="shoe_id" value="<?= $shoe['id'] ?>"/>
                <input type="number" name="size" step="0.5" min="1" max="20" placeholder="Size" required/>
                <input type="number" name="price" placeholder="Price" required/>
                <input type="number" name="stock" placeholder="Stock" required/>
                <select name="variation" required>
                    <option value="" disabled selected>Type...</option>
                    <option value="Mens">US MENS</option>
                    <option value="Womens">US WOMENS</option>
                </select>
                <button type="submit" class="add-size-btn">Add Size</button>
            </form>
        </div>

        <button class="delete-btn" onclick="showPopup('deleteShoe', <?= $shoe['id'] ?>)">Delete Shoe</button>
    </div>
</div>
<?php endwhile; ?>
</div>

<!-- ================= POPUP ================= -->
<div class="popup-overlay" id="popupOverlay">
    <div class="popup-box">
        <h3 id="popupMessage">Are you sure?</h3>
        <button class="popup-confirm" id="popupConfirmBtn">Yes</button>
        <button class="popup-cancel" onclick="hidePopup()">Cancel</button>
    </div>
</div>

<script>
// Add new size row in the add shoe form
function addSize(){
    const div = document.createElement("div");
    div.classList.add("form-grid");
    div.style.marginBottom = "1rem";
    div.innerHTML = `
        <div>
            <label>Size</label>
            <input type="number" name="size" step="0.5" min="1" max="20" placeholder="Size" required/>
        </div>
        <div>
            <label>Price</label>
            <input type="number" name="price[]" placeholder="Price" required />
        </div>
        <div>
            <label>Stock(s)</label>
            <input type="number" name="stock[]" placeholder="Stock" required />
        </div>
        <div>
            <label>Variation</label>
            <select name="variation[]" required>
                <option value="" disabled selected>Select...</option>
                <option value="Mens">US MENS</option>
                <option value="Womens">US WOMENS</option>
            </select>
        </div>
    `;
    document.getElementById("sizesContainer").appendChild(div);
}

// ================= CUSTOM POPUP =================
let currentAction = '';
let currentId = 0;

function showPopup(action, id){
    currentAction = action;
    currentId = id;
    const msg = action === 'deleteSize' ? 'Delete this Row?' : 'Delete this Item?';
    document.getElementById('popupMessage').innerText = msg;
    document.getElementById('popupOverlay').style.display = 'flex';
}

function hidePopup(){
    document.getElementById('popupOverlay').style.display = 'none';
}

// Handle confirm
document.getElementById('popupConfirmBtn').addEventListener('click', function(){
    if(currentAction === 'deleteSize'){
        fetch('delete_size.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'id=' + currentId
        }).then(()=>{ location.reload(); });
    } else if(currentAction === 'deleteShoe'){
        fetch('delete_shoe.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'id=' + currentId
        }).then(()=>{ location.reload(); });
    }
    hidePopup();
});
</script>

</body>
</html>
