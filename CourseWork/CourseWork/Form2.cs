using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.IO;
using System.Threading;
using NLog;

namespace CourseWork
{
    public partial class Form2 : Form
    {
        Logger logger = LogManager.GetCurrentClassLogger();
        string Changed;//изменение времени на label
        string[] file;
        int count = 0;//номер элемента массива
        int plus = 0;//считает количество правильных ответов
        int minus = 0;//считает количество неправильных ответов
        int kol = 1;//считает количество написанных слов
        int tk;//таймер
        int i = 60;//таймер
        int score;//считает за сколько времени была выполнена задание
        int chet = 0;//считает количество правильных слов за 10 секунд
        public Form2(string FileName)
        {
            InitializeComponent();
            file = File.ReadAllLines(FileName);
        }


        private void timer1_Tick(object sender, EventArgs e)//таймер на минуту
        {
            tk = --i;
            TimeSpan span = TimeSpan.FromMinutes(tk);
            string label = span.ToString(@"hh\:mm");
            label1.Text = label.ToString();
            score = 60 - tk;
            if (i == 0)//проверка на то что время вышло
            {
                timer1.Stop();
                timer2.Stop();
                label6.Text = score.ToString();
                WorkChecker(textBox1.Text);
                textBox1.Text = "";
                textBox1.Enabled = false;
                btStart.Enabled = false;
                return;
            }
        }

        private void btStart_Click(object sender, EventArgs e)
        {
            Changed = "01:00";
            label1.Text = Changed;
            timer1.Interval = 1000;
            timer1.Enabled = true;
            timer1.Start();
            timer2.Interval = 10000;
            timer2.Enabled = true;
            timer2.Start();
            label2.Text = file[count];
            textBox1.Text = "";
            logger.Info("Была нажата кнопка Начать");
        }
        public void KeyInput(object sender, KeyEventArgs e)
        {
            if (e.KeyCode == Keys.Enter)//проверка нажата ли была кнопка Enter
            {
                WorkChecker(textBox1.Text);
                label6.Text = score.ToString();
                count++;
                kol++;
                label2.Text = file[count];
                textBox1.Text = "";
            }
        }
        public void WorkChecker(string Word)//проверяет написание слов
        {
            if (Word == file[count])
            {
                plus++;
                chet++;
            }
            else
            {
                minus++;
            }
            label7.Text = $"{plus} из {kol}";
            label8.Text = $"{minus} из {kol}";
            logger.Info($"Количество введенных правильных слов {plus} " +
                $"Количество введенных неправильных слов {minus} " +
                $" Количество всего слов {kol} ");
        }

        private void btBack_Click(object sender, EventArgs e)//переход на форму 1
        {
            Form1 f = new Form1();
            f.Show();
            this.Hide();
            logger.Info("Был переход на главную");
        }

        private void btGraph_Click(object sender, EventArgs e)
        {
            Form f = new Form5();
            f.Show();
            this.Hide();
            logger.Info("Был переход на график");
        }

        private void timer2_Tick(object sender, EventArgs e)//таймер для записания правильных слов в динамический массив и обнуление переменной chet каждые 10 сек
        {
            Chart.Right.Add(chet);
            chet = 0;
        }
    }
}
