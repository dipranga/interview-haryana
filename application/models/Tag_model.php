<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tag_model extends CI_Model
{
    public function get_by_news_id($news_id)
    {
        return $this->db
            ->select('tags.*')
            ->from('tags')
            ->join('news_tags', 'news_tags.tag_id = tags.id')
            ->where('news_tags.news_id', $news_id)
            ->get()->result_array();
    }

    public function get_all_with_count()
    {
        return $this->db
            ->select('tags.*, COUNT(news_tags.news_id) as news_count')
            ->from('tags')
            ->join('news_tags', 'news_tags.tag_id = tags.id', 'left')
            ->group_by('tags.id')
            ->get()->result_array();
    }

    public function sync_for_news($news_id, $tag_names)
    {
        // Remove old pivot rows for this article
        $this->db->where('news_id', $news_id)->delete('news_tags');

        foreach ($tag_names as $name) {
            $name = trim($name);
            if (empty($name)) continue;

            $slug = mb_strtolower(preg_replace('/\s+/', '-', $name));

            // Find or create tag
            $tag = $this->db->where('slug', $slug)->get('tags')->row_array();
            if ( ! $tag) {
                $this->db->insert('tags', array(
                    'name'       => $name,
                    'slug'       => $slug,
                    'created_at' => date('Y-m-d H:i:s'),
                ));
                $tag_id = $this->db->insert_id();
            } else {
                $tag_id = $tag['id'];
            }

            // Insert pivot (ignore duplicate)
            $this->db->query(
                'INSERT IGNORE INTO news_tags (news_id, tag_id) VALUES (?, ?)',
                array($news_id, $tag_id)
            );
        }
    }

    public function delete_tag($id)
    {
        $this->db->where('id', $id)->delete('tags');
    }
}
