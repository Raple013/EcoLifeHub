<?php

namespace Database\Seeders;

use App\Models\QuizQuestion;
use Illuminate\Database\Seeder;

class QuizQuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            // === SDG (10 questions) ===
            ['question' => 'Which SDG focuses on ending poverty?', 'options' => ['SDG 1', 'SDG 5', 'SDG 10', 'SDG 15'], 'answer' => 'SDG 1', 'topic' => 'sdg'],
            ['question' => 'Which SDG focuses on quality education?', 'options' => ['SDG 4', 'SDG 7', 'SDG 13', 'SDG 17'], 'answer' => 'SDG 4', 'topic' => 'sdg'],
            ['question' => 'Which SDG promotes good health and well-being?', 'options' => ['SDG 3', 'SDG 8', 'SDG 11', 'SDG 16'], 'answer' => 'SDG 3', 'topic' => 'sdg'],
            ['question' => 'Which SDG is about clean water and sanitation?', 'options' => ['SDG 6', 'SDG 10', 'SDG 12', 'SDG 15'], 'answer' => 'SDG 6', 'topic' => 'sdg'],
            ['question' => 'Which SDG focuses on climate action?', 'options' => ['SDG 13', 'SDG 3', 'SDG 7', 'SDG 16'], 'answer' => 'SDG 13', 'topic' => 'sdg'],
            ['question' => 'Which SDG protects life below water?', 'options' => ['SDG 14', 'SDG 1', 'SDG 9', 'SDG 11'], 'answer' => 'SDG 14', 'topic' => 'sdg'],
            ['question' => 'Which SDG promotes gender equality?', 'options' => ['SDG 5', 'SDG 2', 'SDG 8', 'SDG 14'], 'answer' => 'SDG 5', 'topic' => 'sdg'],
            ['question' => 'Which SDG focuses on partnerships for the goals?', 'options' => ['SDG 17', 'SDG 1', 'SDG 6', 'SDG 12'], 'answer' => 'SDG 17', 'topic' => 'sdg'],
            ['question' => 'Using solar panels supports which SDG?', 'options' => ['SDG 7', 'SDG 3', 'SDG 10', 'SDG 15'], 'answer' => 'SDG 7', 'topic' => 'sdg'],
            ['question' => 'A city builds bike lanes. Which SDG is most relevant?', 'options' => ['SDG 3 — Good Health', 'SDG 11 — Sustainable Cities', 'SDG 13 — Climate Action', 'All of the above'], 'answer' => 'All of the above', 'topic' => 'sdg'],

            // === NUTRITION (10 questions) ===
            ['question' => 'Which nutrient is the body\'s primary source of energy?', 'options' => ['Carbohydrates', 'Protein', 'Fat', 'Vitamins'], 'answer' => 'Carbohydrates', 'topic' => 'nutrition'],
            ['question' => 'How many calories per gram does protein provide?', 'options' => ['2 kcal', '4 kcal', '7 kcal', '9 kcal'], 'answer' => '4 kcal', 'topic' => 'nutrition'],
            ['question' => 'Which vitamin is mainly obtained from sunlight?', 'options' => ['Vitamin A', 'Vitamin B12', 'Vitamin C', 'Vitamin D'], 'answer' => 'Vitamin D', 'topic' => 'nutrition'],
            ['question' => 'What is the recommended daily water intake for adults?', 'options' => ['1 liter', '2 liters', '4 liters', '5 liters'], 'answer' => '2 liters', 'topic' => 'nutrition'],
            ['question' => 'Which food is highest in protein?', 'options' => ['Rice', 'Chicken breast', 'Banana', 'Butter'], 'answer' => 'Chicken breast', 'topic' => 'nutrition'],
            ['question' => 'What does BMI stand for?', 'options' => ['Body Mass Index', 'Basic Metabolic Intake', 'Body Muscle Index', 'Balanced Meal Indicator'], 'answer' => 'Body Mass Index', 'topic' => 'nutrition'],
            ['question' => 'Which type of fat is considered healthy?', 'options' => ['Trans fat', 'Saturated fat', 'Unsaturated fat', 'Hydrogenated fat'], 'answer' => 'Unsaturated fat', 'topic' => 'nutrition'],
            ['question' => 'What mineral is essential for strong bones?', 'options' => ['Iron', 'Calcium', 'Potassium', 'Zinc'], 'answer' => 'Calcium', 'topic' => 'nutrition'],
            ['question' => 'Which organ is responsible for detoxifying the body?', 'options' => ['Heart', 'Lungs', 'Liver', 'Kidneys'], 'answer' => 'Liver', 'topic' => 'nutrition'],
            ['question' => 'What is a common sign of dehydration?', 'options' => ['Headache', 'Hot feet', 'Blurry vision', 'Ringing ears'], 'answer' => 'Headache', 'topic' => 'nutrition'],

            // === HEALTH & LIFESTYLE (10 questions) ===
            ['question' => 'How many minutes of exercise is recommended per week?', 'options' => ['30 minutes', '75 minutes', '150 minutes', '300 minutes'], 'answer' => '150 minutes', 'topic' => 'health'],
            ['question' => 'Which sleep stage is most important for memory consolidation?', 'options' => ['Light sleep', 'Deep sleep', 'REM sleep', 'Awake'], 'answer' => 'REM sleep', 'topic' => 'health'],
            ['question' => 'What is the normal human body temperature in Celsius?', 'options' => ['35°C', '36-37°C', '38-39°C', '40°C'], 'answer' => '36-37°C', 'topic' => 'health'],
            ['question' => 'Which of the following is a stress management technique?', 'options' => ['Watching TV all day', 'Meditation', 'Skipping meals', 'Sleeping less'], 'answer' => 'Meditation', 'topic' => 'health'],
            ['question' => 'What is the leading cause of preventable death worldwide?', 'options' => ['Diabetes', 'Heart disease', 'Tobacco use', 'Accidents'], 'answer' => 'Tobacco use', 'topic' => 'health'],
            ['question' => 'How often should adults get a health check-up?', 'options' => ['Once a year', 'Every 5 years', 'Only when sick', 'Never'], 'answer' => 'Once a year', 'topic' => 'health'],
            ['question' => 'What does "mental health" primarily refer to?', 'options' => ['Brain surgery', 'Emotional and psychological well-being', 'Intelligence level', 'Memory capacity'], 'answer' => 'Emotional and psychological well-being', 'topic' => 'health'],
            ['question' => 'Which habit improves heart health the most?', 'options' => ['Smoking', 'Regular exercise', 'Eating fast food', 'Sitting all day'], 'answer' => 'Regular exercise', 'topic' => 'health'],
            ['question' => 'What is the recommended screen time limit for children?', 'options' => ['No limit', '4-5 hours/day', '1-2 hours/day', '8 hours/day'], 'answer' => '1-2 hours/day', 'topic' => 'health'],
            ['question' => 'Which disease is caused by lack of insulin?', 'options' => ['Diabetes', 'Asthma', 'Cancer', 'Tuberculosis'], 'answer' => 'Diabetes', 'topic' => 'health'],

            // === ENVIRONMENT (10 questions) ===
            ['question' => 'How long does it take for a plastic bottle to decompose?', 'options' => ['1 year', '10 years', '100 years', '450 years'], 'answer' => '450 years', 'topic' => 'environment'],
            ['question' => 'Which gas is the main contributor to the greenhouse effect?', 'options' => ['Oxygen', 'Nitrogen', 'Carbon dioxide', 'Hydrogen'], 'answer' => 'Carbon dioxide', 'topic' => 'environment'],
            ['question' => 'What does "3R" stand for in waste management?', 'options' => ['Reduce, Reuse, Recycle', 'Read, Write, Repeat', 'Run, Rest, Relax', 'Remove, Replace, Repair'], 'answer' => 'Reduce, Reuse, Recycle', 'topic' => 'environment'],
            ['question' => 'Which energy source is NOT renewable?', 'options' => ['Solar', 'Wind', 'Coal', 'Hydroelectric'], 'answer' => 'Coal', 'topic' => 'environment'],
            ['question' => 'What is the biggest source of ocean pollution?', 'options' => ['Oil spills', 'Plastic waste', 'Sewage', 'Industrial chemicals'], 'answer' => 'Plastic waste', 'topic' => 'environment'],
            ['question' => 'Which animal is most affected by deforestation?', 'options' => ['Orangutans', 'Cows', 'Cats', 'Fish'], 'answer' => 'Orangutans', 'topic' => 'environment'],
            ['question' => 'What is biodiversity?', 'options' => ['Variety of life on Earth', 'Number of humans', 'Amount of water', 'Height of mountains'], 'answer' => 'Variety of life on Earth', 'topic' => 'environment'],
            ['question' => 'Which country produces the most solar energy?', 'options' => ['USA', 'China', 'Germany', 'India'], 'answer' => 'China', 'topic' => 'environment'],
            ['question' => 'What causes acid rain?', 'options' => ['Volcanic eruptions', 'Air pollution from factories', 'Ocean waves', 'Deforestation'], 'answer' => 'Air pollution from factories', 'topic' => 'environment'],
            ['question' => 'Which ecosystem stores the most carbon?', 'options' => ['Rainforests', 'Oceans', 'Grasslands', 'Deserts'], 'answer' => 'Oceans', 'topic' => 'environment'],

            // === GENERAL KNOWLEDGE (10 questions) ===
            ['question' => 'Which planet is known as the Red Planet?', 'options' => ['Venus', 'Mars', 'Jupiter', 'Saturn'], 'answer' => 'Mars', 'topic' => 'general'],
            ['question' => 'What is the largest organ in the human body?', 'options' => ['Heart', 'Liver', 'Skin', 'Brain'], 'answer' => 'Skin', 'topic' => 'general'],
            ['question' => 'Which language has the most native speakers?', 'options' => ['English', 'Mandarin Chinese', 'Spanish', 'Hindi'], 'answer' => 'Mandarin Chinese', 'topic' => 'general'],
            ['question' => 'What is the chemical symbol for water?', 'options' => ['O2', 'H2O', 'CO2', 'NaCl'], 'answer' => 'H2O', 'topic' => 'general'],
            ['question' => 'Who developed the theory of relativity?', 'options' => ['Newton', 'Einstein', 'Hawking', 'Galileo'], 'answer' => 'Einstein', 'topic' => 'general'],
            ['question' => 'Which country invented paper?', 'options' => ['India', 'Egypt', 'China', 'Greece'], 'answer' => 'China', 'topic' => 'general'],
            ['question' => 'How many bones are in the adult human body?', 'options' => ['106', '206', '306', '406'], 'answer' => '206', 'topic' => 'general'],
            ['question' => 'What does "www" stand for?', 'options' => ['World Wide Web', 'Wide World Web', 'Web World Wide', 'World Web Wide'], 'answer' => 'World Wide Web', 'topic' => 'general'],
            ['question' => 'Which blood type is the universal donor?', 'options' => ['A+', 'B+', 'O-', 'AB+'], 'answer' => 'O-', 'topic' => 'general'],
            ['question' => 'What is the capital of Indonesia?', 'options' => ['Jakarta', 'Nusantara', 'Surabaya', 'Bandung'], 'answer' => 'Nusantara', 'topic' => 'general'],
        ];

        foreach ($questions as $q) {
            QuizQuestion::create($q);
        }
    }
}
