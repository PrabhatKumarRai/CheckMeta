<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Meta</title>
    <meta name="description" content="Check and Generate Website Meta tags">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    
        <!-- Header Section -->
        <div class="header">
            <div class="header-top">
                <h1>Check Meta</h1>
                <p>Easily Check Website Meta tags</p>
            </div>
            <div class="header-bottom search-container">
                <form method="get">
                    <input type="text" name="website_url" placeholder="Enter website address" value="<?= !empty($_GET['website_url'])? $_GET['website_url']: ''; ?>">
                    <button type="submit">Check Meta</button>
                </form>
            </div>
        </div>

        <!-- Content Section -->
        <div class="content-wrapper">

            <?php 
                if(file_exists(__DIR__."/process/process.php") && !empty($_GET['website_url'])):
                    include __DIR__."/process/process.php";                
            ?>         

            <!-- Website Address -->
            <div class="section">
                <div class="section-head">
                    <h2>Website Address</h2>
                    <p>The address people will type in to get to your website.</p>
                </div>
                <div class="section-content">
                    <h3><?= !empty($_GET['website_url'])? strtolower($_GET['website_url']): 'Not found'; ?></h3>
                </div>
            </div>
            
                <?php
                    if(!isset($data['error'])):
                ?>

                        <!-- Social Section -->
                        <?php if( !empty($data['og_image']) || !empty($data['og_title']) || !empty($data['og_description']) ): ?>
                            <div class="section">
                                <div class="section-head">
                                    <h2>Social Card Preview</h2>
                                    <p>This is how your website could look like when someone shares it.</p>
                                </div>
                                <div class="section-content social-card-preview">
                                    <?php if(!empty($data['og_image'])): ?>
                                        <div class="social-card-image">
                                            <img src="<?= $data['og_image']; ?>">
                                        </div>
                                    <?php endif; ?>

                                    <div class="social-card-content">
                                        <?php if(!empty($data['og_title'])): ?>
                                            <h3 class="social-card-title"><?= $data['og_title']; ?></h3>
                                        <?php endif; ?>
                                        <?php if(!empty($data['og_description'])): ?>
                                            <p class="social-card-description"><?= $data['og_description']; ?></p>
                                        <?php endif; ?>
                                        <p class="social-card-url"><?= (!empty($data['og_url']))? $data['og_url']: strtolower($_GET['website_url']); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Google Preview -->
                        <?php if(!empty($data['seo_title'])): ?>
                            <div class="section google-serp-preview">
                                <div class="section-head">
                                    <h2>Google SERP Preview</h2>
                                    <p>This is how your website could look in Google.</p>
                                </div>
                                <div class="section-content">
                                    <p class="google-serp-preview-breadcrumb-link"><?= strtolower($_GET['website_url']); ?></p>
                                    <h3 class="google-serp-preview-title"><?= (strlen($data['seo_title']) > 60)? substr($data['seo_title'], 0, 60)."...": $data['seo_title']; ?></h3>
                                    <p class="google-serp-preview-description"><?= (strlen($data['meta_description']) > 160)? substr($data['meta_description'], 0, 160)."...": $data['meta_description']; ?></p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- SEO Title -->
                        <div class="section">
                            <div class="section-head">
                                <h2>Title</h2>
                                <p>Defines the title of the page.</p>
                            </div>
                            <div class="section-content">
                                <h3><?= !empty($data['seo_title'])? $data['seo_title']: ''; ?></h3>
                            </div>
                        </div>

                        <!-- Meta Description -->
                        <div class="section">
                            <div class="section-head">
                                <h2>Description</h2>
                                <p>Define a description of your web page.</p>
                            </div>
                            <div class="section-content">
                                <h3><?= !empty($data['meta_description'])? $data['meta_description']: ''; ?></h3>
                            </div>
                        </div>

                        <!-- OG Image -->
                        <div class="section">
                            <div class="section-head">
                                <h2>Social Image</h2>
                                <p>Image displayed when sharing the website.</p>
                            </div>
                            <?php if(!empty($data['og_image'])): ?>
                                <div class="section-content og-image">
                                    <h3><?= $data['og_image']; ?></h3>
                                </div>
                                <img src="<?= $data['og_image']; ?>" alt="">
                            <?php endif; ?>
                        </div>

                <?php 
                    else:
                ?>
                        <!-- Error -->
                        <div class="section">
                            <div class="section-head">
                                <h2>Error</h2>
                            </div>
                            <div class="section-content">
                                <h3><?= $data['error']; ?></h3>
                            </div>
                        </div>
                <?php
                    endif;
                ?>
            
            <?php 
                endif; 
            ?>

        </div>       

        <!-- Footer Section -->
        <div class="footer">
            <hr>
            <p>Developed By Prabhat Rai</p>
            <hr>
        </div>

    </div>
</body>
</html>