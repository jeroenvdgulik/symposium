<?php

class TalkRevision extends UuidBase
{
    protected $title;
    protected $type;
    protected $length;
    protected $level;
    protected $description;
    protected $slides;
    protected $organizer_notes;

    protected $table = 'talk_revisions';

    protected $guarded = [
        'id'
    ];

    public static $rules = [];

    public function talk()
    {
        return $this->belongsTo('Talk');
    }

    public function getUrl()
    {
        return '/talks/' . $this->talk->id . '/?revision=' . $this->id;
    }

    public function getDescription()
    {
        return $this->htmlize($this->getAttribute('description'), false);
    }

    public function getHtmledDescription()
    {
        return $this->htmlize($this->getAttribute('description'));
    }

    public function getHtmledOrganizerNotes()
    {
        return $this->htmlize($this->getAttribute('organizer_notes'));
    }

    private function htmlize($string, $changeNewLineToBR = true)
    {
        if ($string == '') {
            return '<i>(empty)</i>';
        }

        return $changeNewLineToBR ? str_replace("\n", "<br>", $string) : $string;
    }
}
