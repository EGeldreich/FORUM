
-- GET NUMBER OF POSTS + TOPICS PER USER
SELECT
    t.nickname,
    COUNT(DISTINCT topic.id_topic) + COUNT(DISTINCT post.id_post) AS number
FROM user t
LEFT JOIN topic ON t.id_user = topic.user_id
LEFT JOIN post ON t.id_user = post.user_id
GROUP BY t.id_user
LIMIT 5;

-- GET ALL RELEVANT POST DATAS
SELECT
	t.id_topic,
	t.title,
	t.user_id,
	t.content,
	p.id_post,
	p.content AS postContent,
	p.postDate AS postDate,
	p.user_id,
	u.nickname AS postUser,
	(SELECT COUNT(*) FROM post WHERE user_id = u.id_user) AS totalPosts,
	(SELECT COUNT(*) FROM topic WHERE user_id = u.id_user) AS totalTopics,
	ROW_NUMBER() OVER (ORDER BY p.postDate) AS responseNumber
FROM
	topic t
LEFT JOIN post p ON t.id_topic = p.topic_id
LEFT JOIN user u ON p.user_id = u.id_user
WHERE t.id_topic = 1
ORDER BY
	p.postDate

