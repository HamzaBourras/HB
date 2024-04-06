
        // reformater les reponses des étudiants
        foreach ($studentQuiz['questions'] as $studQuestion) {
                $sFormatQues = [
                    "questionId" => $studQuestion['id'],
                    "questionNote" => $studQuestion['note'],
                    "answers" => []
                ];
            foreach ($studQuestion['answers'] as $studAnswers) {
                $sFormatAnsw = [
                    "answersId" => $studAnswers['id'],
                    "answerIsCorrect" => $studAnswers['isCorrect']
                ];

                array_push($sFormatQues['answers'], $sFormatAnsw);
            }
            array_push($studentQuizFormat, $sFormatQues);
        }

        // reformater les reponses qui est dans la base de données
        foreach ($dataBaseQuiz['questions'] as $dataBaseQuestion) {
                $dFormatQues = [
                    "questionId" => $dataBaseQuestion['id'],
                    "questionNote" => $dataBaseQuestion['note'],
                    "answers" => []
                ];
            foreach ($dataBaseQuestion['choices'] as $dataBaseAnswers) {
                $dFormatAnsw = [
                    "answersId" => $dataBaseAnswers['id'],
                    "answerIsCorrect" => $dataBaseAnswers['tr_fl']
                ];

                array_push($dFormatQues['answers'], $dFormatAnsw);
            }
            array_push($dataBaseQuizFormat, $dFormatQues);
        }


        