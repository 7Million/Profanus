<?php

/**
 * developed by Tadiwanashe Mataruse 2019-04-08
 * email: 7millionatives@gmail.com / developa89@gmail.com
 * tested on PHP 7
 **/
class Profanus
{

  /*  this is an array of blacklisted words, can be generated from a database or file or direct in the script 
   *   for best result, just make sure you add the profanity words in smallcase eg 'bitch','pussy'
   */

  private function black_list()
  {
    $bad_words = array('fck', 'fuck', 'ass', 'babe', 'sexy', 'bitch');
    $more_bad_words = $this->read_dictionary();
    $bad_words = array_merge($bad_words,$more_bad_words);

    return $bad_words;
  }

  /** the following function uses a text file as its dictionary. so instead of putting the badwords into an array above
   *  you can add the words in small caps into the text file separating each word with a new line for example:
   *  bitch
   *  ass
   *  dick
   *  nigger
   *  just as words and do not put quotes or anything around the words.
  **/
  function read_dictionary()
  {
    $bad_word_lines = file('blacklist.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    return $bad_word_lines;
  }

// the below function focuses on the censorship of the whole sentence but then automatically skips the first word hence the need for the later functions
  function censor_sentence($sentence)
  {

    $bad_words = $this->black_list();
    $bad_words_count = count($bad_words);

    for ($i = 0; $i < $bad_words_count; $i++) {
      if (strpos(strtolower($sentence), $bad_words[$i])) {
        $dirtyWordLength = strlen($bad_words[$i]);
        $clean_sentence = str_ireplace($bad_words[$i], str_repeat('*', $dirtyWordLength), $sentence);
        $clean = false;
        $sentence = $clean_sentence;
      } else {
        $clean = true;
      }
    }
    if ($clean) {
      return $sentence;
    } else {
      return $sentence;
    }

  }

// the below function focuses only on the censorship of the first word of the sentence, this was my chosen approach  
  function censor_first_word($sentence)
  {

    $first_word = strtok($sentence, " ");
    $bad_words = $this->black_list();
    $bad_words_count = count($bad_words);

    for ($i = 0; $i < $bad_words_count; $i++) {
      if (strpos(strtolower($sentence), $bad_words[$i]) === 0) {

        $first_word_len = strlen($first_word);
        $bad_word_len = strlen($bad_words[$i]);

        if (strcasecmp($first_word, $bad_words[$i]) == 0) {
          $char_count = $first_word_len;
        }

        if (strcasecmp($first_word, $bad_words[$i]) !== 0 && $first_word_len > $bad_word_len) {
          $char_count = $bad_word_len;
        }

        if (strcasecmp($first_word, $bad_words[$i]) !== 0 && $first_word_len < $bad_word_len) {
          $char_count = $first_word_len;
        }

        $clean_first_wd = array();
        for ($j = 0; $j < $char_count; $j++) {
          array_push($clean_first_wd, "*");
        }
        $clean_first_word = implode("", $clean_first_wd);
        $sentence = str_replace($first_word, $clean_first_word, $sentence);
        for ($i = 0; $i < $bad_words_count; $i++) {
          if (strpos($sentence, $bad_words[$i])) {
            $dirtyWordLength = strlen($bad_words[$i]);
            $clean_sentence = str_ireplace($bad_words[$i], str_repeat('*', $dirtyWordLength), $sentence);
            $clean = false;
            $sentence = $clean_sentence;
          } else {
            $clean = true;
          }
        }
      }
    }

    if ($clean) {
      return strtok($sentence, " ");
    } else {
      return strtok($sentence, " ");
    }

  }

// combining the censorship functions into one method:
  function censor($sentence)
  {
    $censored_first_word = $this->censor_first_word($sentence);
    $sentence = $this->remove_first_word($sentence);
    $censored_sentence = $this->censor_sentence($sentence);
    $final_censored = $censored_first_word . $censored_sentence;

    return $final_censored;
  }

// removing the first word from the uncensored sentence so that later this function output will be joined to the censor_first_word() output
  private function remove_first_word($sentence)
  {
    $first_word = strtok($sentence, " ");
    $first_word_len = strlen($first_word);
    $trimmed = substr($sentence, $first_word_len);

    return $trimmed;
  }

}

?>
