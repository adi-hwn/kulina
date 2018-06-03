USE userdb5;

DROP TABLE IF EXISTS user_review;

CREATE TABLE user_review
(
    id             INT unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    order_id       INT unsigned NOT NULL,
    product_id     VARCHAR(32) NOT NULL,
    user_id        VARCHAR(32),
    rating         FLOAT(24),
    review         VARCHAR(140),
    created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
