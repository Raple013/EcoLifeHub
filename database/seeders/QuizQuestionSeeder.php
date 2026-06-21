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
            ['question' => 'Which SDG focuses on ending poverty?', 'options' => ['SDG 1', 'SDG 5', 'SDG 10', 'SDG 15'], 'answer' => 'SDG 1', 'topic' => 'sdg', 'explanation' => 'SDG 1 (No Poverty) aims to end poverty in all its forms everywhere by 2030.'],
            ['question' => 'Which SDG focuses on quality education?', 'options' => ['SDG 4', 'SDG 7', 'SDG 13', 'SDG 17'], 'answer' => 'SDG 4', 'topic' => 'sdg', 'explanation' => 'SDG 4 (Quality Education) ensures inclusive and equitable quality education for all.'],
            ['question' => 'Which SDG promotes good health and well-being?', 'options' => ['SDG 3', 'SDG 8', 'SDG 11', 'SDG 16'], 'answer' => 'SDG 3', 'topic' => 'sdg', 'explanation' => 'SDG 3 (Good Health and Well-being) ensures healthy lives and promotes well-being for all.'],
            ['question' => 'Which SDG is about clean water and sanitation?', 'options' => ['SDG 6', 'SDG 10', 'SDG 12', 'SDG 15'], 'answer' => 'SDG 6', 'topic' => 'sdg', 'explanation' => 'SDG 6 (Clean Water and Sanitation) ensures availability and sustainable management of water.'],
            ['question' => 'Which SDG focuses on climate action?', 'options' => ['SDG 13', 'SDG 3', 'SDG 7', 'SDG 16'], 'answer' => 'SDG 13', 'topic' => 'sdg', 'explanation' => 'SDG 13 (Climate Action) calls for urgent action to combat climate change and its impacts.'],
            ['question' => 'Which SDG protects life below water?', 'options' => ['SDG 14', 'SDG 1', 'SDG 9', 'SDG 11'], 'answer' => 'SDG 14', 'topic' => 'sdg', 'explanation' => 'SDG 14 (Life Below Water) aims to conserve and sustainably use the oceans, seas, and marine resources.'],
            ['question' => 'Which SDG promotes gender equality?', 'options' => ['SDG 5', 'SDG 2', 'SDG 8', 'SDG 14'], 'answer' => 'SDG 5', 'topic' => 'sdg', 'explanation' => 'SDG 5 (Gender Equality) aims to achieve gender equality and empower all women and girls.'],
            ['question' => 'Which SDG focuses on partnerships for the goals?', 'options' => ['SDG 17', 'SDG 1', 'SDG 6', 'SDG 12'], 'answer' => 'SDG 17', 'topic' => 'sdg', 'explanation' => 'SDG 17 (Partnerships for the Goals) strengthens the means of implementation and revitalizes global partnerships.'],
            ['question' => 'Using solar panels supports which SDG?', 'options' => ['SDG 7', 'SDG 3', 'SDG 10', 'SDG 15'], 'answer' => 'SDG 7', 'topic' => 'sdg', 'explanation' => 'SDG 7 (Affordable and Clean Energy) ensures access to affordable, reliable, sustainable, and modern energy.'],
            ['question' => 'A city builds bike lanes. Which SDG is most relevant?', 'options' => ['SDG 3 — Good Health', 'SDG 11 — Sustainable Cities', 'SDG 13 — Climate Action', 'All of the above'], 'answer' => 'All of the above', 'topic' => 'sdg', 'explanation' => 'Building bike lanes contributes to SDG 3 (health), SDG 11 (sustainable cities), and SDG 13 (climate action).'],

            // === NUTRITION (10 questions) ===
            ['question' => 'Which nutrient is the body\'s primary source of energy?', 'options' => ['Carbohydrates', 'Protein', 'Fat', 'Vitamins'], 'answer' => 'Carbohydrates', 'topic' => 'nutrition', 'explanation' => 'Carbohydrates are the body\'s preferred and primary source of energy, broken down into glucose.'],
            ['question' => 'How many calories per gram does protein provide?', 'options' => ['2 kcal', '4 kcal', '7 kcal', '9 kcal'], 'answer' => '4 kcal', 'topic' => 'nutrition', 'explanation' => 'Protein provides 4 kilocalories per gram, the same as carbohydrates. Fat provides 9 kcal/g.'],
            ['question' => 'Which vitamin is mainly obtained from sunlight?', 'options' => ['Vitamin A', 'Vitamin B12', 'Vitamin C', 'Vitamin D'], 'answer' => 'Vitamin D', 'topic' => 'nutrition', 'explanation' => 'Vitamin D is synthesized in the skin upon exposure to sunlight, specifically UVB rays.'],
            ['question' => 'What is the recommended daily water intake for adults?', 'options' => ['1 liter', '2 liters', '4 liters', '5 liters'], 'answer' => '2 liters', 'topic' => 'nutrition', 'explanation' => 'The general recommendation is about 2 liters (8 glasses) of water per day for adults.'],
            ['question' => 'Which food is highest in protein?', 'options' => ['Rice', 'Chicken breast', 'Banana', 'Butter'], 'answer' => 'Chicken breast', 'topic' => 'nutrition', 'explanation' => 'Chicken breast is a lean source of protein, containing about 31g of protein per 100g.'],
            ['question' => 'What does BMI stand for?', 'options' => ['Body Mass Index', 'Basic Metabolic Intake', 'Body Muscle Index', 'Balanced Meal Indicator'], 'answer' => 'Body Mass Index', 'topic' => 'nutrition', 'explanation' => 'BMI (Body Mass Index) is a measure of body fat based on weight and height.'],
            ['question' => 'Which type of fat is considered healthy?', 'options' => ['Trans fat', 'Saturated fat', 'Unsaturated fat', 'Hydrogenated fat'], 'answer' => 'Unsaturated fat', 'topic' => 'nutrition', 'explanation' => 'Unsaturated fats (found in olive oil, avocados, nuts) are heart-healthy fats.'],
            ['question' => 'What mineral is essential for strong bones?', 'options' => ['Iron', 'Calcium', 'Potassium', 'Zinc'], 'answer' => 'Calcium', 'topic' => 'nutrition', 'explanation' => 'Calcium is the most abundant mineral in the body and is essential for bone health.'],
            ['question' => 'Which organ is responsible for detoxifying the body?', 'options' => ['Heart', 'Lungs', 'Liver', 'Kidneys'], 'answer' => 'Liver', 'topic' => 'nutrition', 'explanation' => 'The liver processes toxins, metabolizes drugs, and filters blood coming from the digestive tract.'],
            ['question' => 'What is a common sign of dehydration?', 'options' => ['Headache', 'Hot feet', 'Blurry vision', 'Ringing ears'], 'answer' => 'Headache', 'topic' => 'nutrition', 'explanation' => 'Headaches are a common early sign of dehydration, along with dry mouth and fatigue.'],

            // === HEALTH & LIFESTYLE (10 questions) ===
            ['question' => 'How many minutes of exercise is recommended per week?', 'options' => ['30 minutes', '75 minutes', '150 minutes', '300 minutes'], 'answer' => '150 minutes', 'topic' => 'health', 'explanation' => 'The WHO recommends at least 150 minutes of moderate-intensity aerobic activity per week.'],
            ['question' => 'Which sleep stage is most important for memory consolidation?', 'options' => ['Light sleep', 'Deep sleep', 'REM sleep', 'Awake'], 'answer' => 'REM sleep', 'topic' => 'health', 'explanation' => 'REM (Rapid Eye Movement) sleep is crucial for memory consolidation and learning.'],
            ['question' => 'What is the normal human body temperature in Celsius?', 'options' => ['35°C', '36-37°C', '38-39°C', '40°C'], 'answer' => '36-37°C', 'topic' => 'health', 'explanation' => 'Normal body temperature ranges between 36-37°C (96.8-98.6°F).'],
            ['question' => 'Which of the following is a stress management technique?', 'options' => ['Watching TV all day', 'Meditation', 'Skipping meals', 'Sleeping less'], 'answer' => 'Meditation', 'topic' => 'health', 'explanation' => 'Meditation is a scientifically proven technique for reducing stress and anxiety.'],
            ['question' => 'What is the leading cause of preventable death worldwide?', 'options' => ['Diabetes', 'Heart disease', 'Tobacco use', 'Accidents'], 'answer' => 'Tobacco use', 'topic' => 'health', 'explanation' => 'Tobacco use causes over 8 million deaths annually and is the leading preventable cause of death.'],
            ['question' => 'How often should adults get a health check-up?', 'options' => ['Once a year', 'Every 5 years', 'Only when sick', 'Never'], 'answer' => 'Once a year', 'topic' => 'health', 'explanation' => 'Annual health check-ups help detect health issues early before they become serious.'],
            ['question' => 'What does "mental health" primarily refer to?', 'options' => ['Brain surgery', 'Emotional and psychological well-being', 'Intelligence level', 'Memory capacity'], 'answer' => 'Emotional and psychological well-being', 'topic' => 'health', 'explanation' => 'Mental health encompasses our emotional, psychological, and social well-being.'],
            ['question' => 'Which habit improves heart health the most?', 'options' => ['Smoking', 'Regular exercise', 'Eating fast food', 'Sitting all day'], 'answer' => 'Regular exercise', 'topic' => 'health', 'explanation' => 'Regular exercise strengthens the heart muscle, lowers blood pressure, and improves circulation.'],
            ['question' => 'What is the recommended screen time limit for children?', 'options' => ['No limit', '4-5 hours/day', '1-2 hours/day', '8 hours/day'], 'answer' => '1-2 hours/day', 'topic' => 'health', 'explanation' => 'The AAP recommends no more than 1-2 hours of screen time per day for children aged 2-5.'],
            ['question' => 'Which disease is caused by lack of insulin?', 'options' => ['Diabetes', 'Asthma', 'Cancer', 'Tuberculosis'], 'answer' => 'Diabetes', 'topic' => 'health', 'explanation' => 'Diabetes is characterized by insufficient insulin production or insulin resistance.'],

            // === ENVIRONMENT (10 questions) ===
            ['question' => 'How long does it take for a plastic bottle to decompose?', 'options' => ['1 year', '10 years', '100 years', '450 years'], 'answer' => '450 years', 'topic' => 'environment', 'explanation' => 'Plastic bottles take approximately 450 years to decompose in landfills.'],
            ['question' => 'Which gas is the main contributor to the greenhouse effect?', 'options' => ['Oxygen', 'Nitrogen', 'Carbon dioxide', 'Hydrogen'], 'answer' => 'Carbon dioxide', 'topic' => 'environment', 'explanation' => 'CO2 is the primary greenhouse gas emitted through human activities like burning fossil fuels.'],
            ['question' => 'What does "3R" stand for in waste management?', 'options' => ['Reduce, Reuse, Recycle', 'Read, Write, Repeat', 'Run, Rest, Relax', 'Remove, Replace, Repair'], 'answer' => 'Reduce, Reuse, Recycle', 'topic' => 'environment', 'explanation' => 'The 3Rs hierarchy prioritizes reducing waste, reusing items, and then recycling materials.'],
            ['question' => 'Which energy source is NOT renewable?', 'options' => ['Solar', 'Wind', 'Coal', 'Hydroelectric'], 'answer' => 'Coal', 'topic' => 'environment', 'explanation' => 'Coal is a fossil fuel that takes millions of years to form and is not renewable.'],
            ['question' => 'What is the biggest source of ocean pollution?', 'options' => ['Oil spills', 'Plastic waste', 'Sewage', 'Industrial chemicals'], 'answer' => 'Plastic waste', 'topic' => 'environment', 'explanation' => 'Plastic waste accounts for 80% of all marine debris, with 8 million tons entering oceans annually.'],
            ['question' => 'Which animal is most affected by deforestation?', 'options' => ['Orangutans', 'Cows', 'Cats', 'Fish'], 'answer' => 'Orangutans', 'topic' => 'environment', 'explanation' => 'Orangutans lose their habitat to palm oil plantations, pushing them toward extinction.'],
            ['question' => 'What is biodiversity?', 'options' => ['Variety of life on Earth', 'Number of humans', 'Amount of water', 'Height of mountains'], 'answer' => 'Variety of life on Earth', 'topic' => 'environment', 'explanation' => 'Biodiversity refers to the variety of all life forms on Earth, from genes to ecosystems.'],
            ['question' => 'Which country produces the most solar energy?', 'options' => ['USA', 'China', 'Germany', 'India'], 'answer' => 'China', 'topic' => 'environment', 'explanation' => 'China is the world leader in solar energy production with over 300 GW installed capacity.'],
            ['question' => 'What causes acid rain?', 'options' => ['Volcanic eruptions', 'Air pollution from factories', 'Ocean waves', 'Deforestation'], 'answer' => 'Air pollution from factories', 'topic' => 'environment', 'explanation' => 'Sulfur dioxide and nitrogen oxides from factories react with water vapor to form acid rain.'],
            ['question' => 'Which ecosystem stores the most carbon?', 'options' => ['Rainforests', 'Oceans', 'Grasslands', 'Deserts'], 'answer' => 'Oceans', 'topic' => 'environment', 'explanation' => 'Oceans are the largest carbon sink, absorbing about 25% of CO2 emissions.'],

            // === GENERAL KNOWLEDGE (10 questions) ===
            ['question' => 'Which planet is known as the Red Planet?', 'options' => ['Venus', 'Mars', 'Jupiter', 'Saturn'], 'answer' => 'Mars', 'topic' => 'general', 'explanation' => 'Mars appears red due to iron oxide (rust) on its surface.'],
            ['question' => 'What is the largest organ in the human body?', 'options' => ['Heart', 'Liver', 'Skin', 'Brain'], 'answer' => 'Skin', 'topic' => 'general', 'explanation' => 'The skin is the largest organ, covering about 1.5-2 square meters in adults.'],
            ['question' => 'Which language has the most native speakers?', 'options' => ['English', 'Mandarin Chinese', 'Spanish', 'Hindi'], 'answer' => 'Mandarin Chinese', 'topic' => 'general', 'explanation' => 'Mandarin Chinese has over 920 million native speakers, the most of any language.'],
            ['question' => 'What is the chemical symbol for water?', 'options' => ['O2', 'H2O', 'CO2', 'NaCl'], 'answer' => 'H2O', 'topic' => 'general', 'explanation' => 'H2O represents two hydrogen atoms bonded to one oxygen atom.'],
            ['question' => 'Who developed the theory of relativity?', 'options' => ['Newton', 'Einstein', 'Hawking', 'Galileo'], 'answer' => 'Einstein', 'topic' => 'general', 'explanation' => 'Albert Einstein published his theory of special relativity in 1905 and general relativity in 1915.'],
            ['question' => 'Which country invented paper?', 'options' => ['India', 'Egypt', 'China', 'Greece'], 'answer' => 'China', 'topic' => 'general', 'explanation' => 'Paper was invented in China during the Han Dynasty around 105 AD by Cai Lun.'],
            ['question' => 'How many bones are in the adult human body?', 'options' => ['106', '206', '306', '406'], 'answer' => '206', 'topic' => 'general', 'explanation' => 'The adult human skeleton consists of 206 bones. Babies have about 270 bones that fuse as they grow.'],
            ['question' => 'What does "www" stand for?', 'options' => ['World Wide Web', 'Wide World Web', 'Web World Wide', 'World Web Wide'], 'answer' => 'World Wide Web', 'topic' => 'general', 'explanation' => 'The World Wide Web was invented by Tim Berners-Lee in 1989.'],
            ['question' => 'Which blood type is the universal donor?', 'options' => ['A+', 'B+', 'O-', 'AB+'], 'answer' => 'O-', 'topic' => 'general', 'explanation' => 'O- blood lacks A, B, and Rh antigens, making it safe for transfusion to any blood type.'],
            ['question' => 'What is the capital of Indonesia?', 'options' => ['Jakarta', 'Nusantara', 'Surabaya', 'Bandung'], 'answer' => 'Nusantara', 'topic' => 'general', 'explanation' => 'Nusantara is the new capital of Indonesia, replacing Jakarta.'],
        ];

        foreach ($questions as $q) {
            QuizQuestion::create($q);
        }
    }
}
