
-- GET NUMBER OF POSTS + TOPICS PER USER
SELECT
    t.nickname,
    COUNT(DISTINCT topic.id_topic) + COUNT(DISTINCT post.id_post) AS number
FROM user t
LEFT JOIN topic ON t.id_user = topic.user_id
LEFT JOIN post ON t.id_user = post.user_id
GROUP BY t.id_user
LIMIT 5;