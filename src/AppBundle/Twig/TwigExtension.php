<?php
namespace AppBundle\Twig;

use AppBundle\Entity\PollAnswer;
use Twig_Extension;


/**
 * twig filters
 *
 * Class TwigExtension
 * @package AppBundle\Twig
 */
class TwigExtension extends Twig_Extension
{
    /**
     * Returns a list of filters to add to the existing list.
     *
     * @return array An array of filters
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('percentVote', array($this, 'percentVote'))
        );
    }

    /**
     * @param $answer PollAnswer
     * @return float|int
     */
    public function percentVote($answer)
    {
        $question = $answer->getQuestion();
        $numberOfAllVotes = 0;

        foreach ($question->getAnswers() as $op) {
            $numberOfAllVotes += count($op->getVotes());
        }

        if($numberOfAllVotes > 0) {
            $percent = count($answer->getVotes()) * 100 / $numberOfAllVotes;
        } else {
            $percent = 0;
        }

        return $percent;
    }
}